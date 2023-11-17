<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FilePath;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Helpers\File as FileHelpers;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    protected PostRepositoryInterface $postRepository;

    /**
     * PostController constructor
     * @param PostRepositoryInterface $PostRepositoryInterface
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Render screen post list
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pageTitle = 'Post';
        $posts = $this->postRepository->getAll();
        $posts = $posts->onEachSide($posts->lastPage());

        return view('admin.post.index')
            ->with('posts', $posts)
            ->with('pageTitle', $pageTitle);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Add Post';

        return view('admin.post.add-edit')
            ->with('pageTitle', $pageTitle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return mixed array
     */
    public function store(PostRequest $request)
    {
        $subContentList = json_decode($request->content);
        $content = [];

        foreach ($subContentList as $contentItem) {
            $imagePath = FileHelpers::uploadFileBase64ToPublic($contentItem->imagePath);

            if ($imagePath) {
                $data = [
                    'image' => $imagePath,
                    'content' => $contentItem->content
                ];
                array_push($content, $data);
            }
        }

        $image = FileHelpers::uploadImageToPublic($request->file('image_title'));
        if (!$image) {
            return Response::json([
                'success' => false,
                'message' => Lang::get('notification-message.FILE_MOVE_ERROR'),
            ]);
        }

        $data = collect($request->only(['title', 'content_title']))
            ->merge([
                'image_title' => $image,
                'content' => json_encode($content),
            ])
            ->toArray();

        if ($this->postRepository->create($data)) {
            return Response::json([
                'success' => true,
                'message' => Lang::get('notification-message.REGISTER_SUCESS'),
            ]);
        } else {
            return Response::json([
                'success' => false,
                'message' => Lang::get('notification-message.REGISTER_ERROR'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Post show';
        $post = $this->postRepository->getById($id);
        if ($post) {
            $post->content = json_decode($post->content);
            return view('admin.post.show')
                ->with('post', $post)
                ->with('pageTitle', $pageTitle);
        }
        return redirect()->route('admin.post.index')
            ->with('message', Lang::get('notification-message.NOT_FOUND', ['model' => "Post with $id "]))
            ->with('success', false);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->postRepository->destroy($id);

        if ($result) {
            return redirect()->route('admin.post.index')
                ->with('message', Lang::get('notification-message.DELETE_SUCESS'))
                ->with('success', true);
        }

        return redirect()->route('admin.post.index')
            ->with('message', Lang::get('notification-message.DELETE_ERROR'))
            ->with('success', false);
    }
}
