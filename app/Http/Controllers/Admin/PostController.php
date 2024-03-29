<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FilePath;
use App\Enums\TypeImage;
use App\Helpers\File as FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    const PAGINATION = 10;

    protected PostRepositoryInterface $postRepository;

    protected CategoryRepositoryInterface $categoryRepository;

    /**
     * PostController constructor
     *
     * @param  PostRepositoryInterface  $PostRepositoryInterface
     */
    public function __construct(PostRepositoryInterface $postRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Render screen post list
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $pageTitle = 'Post';
        if ($request->has('search')) {
            $orderColumns = ['id' => 'desc'];
            $posts = $this->postRepository->getByConditions($request->all(), self::PAGINATION, true, null, $orderColumns);
        } else {
            $posts = $this->postRepository->getAll();
        }

        $posts = $posts->onEachSide($posts->lastPage());

        return view('admin.post.index')
            ->with('posts', $posts)
            ->with('pageTitle', $pageTitle)
            ->with('conditions', $request->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Add Post';
        $categories = $this->categoryRepository->getAll(null, false);

        return view('admin.post.add-edit')
            ->with('pageTitle', $pageTitle)
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
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
                    'content' => $contentItem->content,
                ];
                array_push($content, $data);
            }
        }

        $image = FileHelpers::uploadImageToPublic($request->file('image_title'), FilePath::IMAGE_POST_TITLE);
        if (! $image) {
            return Response::json([
                'success' => false,
                'message' => Lang::get('notification-message.FILE_MOVE_ERROR'),
            ]);
        }

        $data = collect($request->only(['title', 'content_title']))
            ->merge([
                'image_title' => $image,
                'content' => json_encode($content),
                'category_id' => $request->category,
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
            return view('admin.post.show')
                ->with('post', $post)
                ->with('pageTitle', $pageTitle);
        }

        return redirect()->route('admin.post.index')
            ->with('message', Lang::get('notification-message.NOT_FOUND', ['model' => "Post with $id "]))
            ->with('success', false);
    }

    /**
     * Show the form for editing the post.
     *
     * @return redirect| \Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        $pageTitle = 'Post edit';
        $post = $this->postRepository->getById($id);
        if ($post) {
            $categories = $this->categoryRepository->getAll(null, false);

            return view('admin.post.edit')
                ->with('post', $post)
                ->with('pageTitle', $pageTitle)
                ->with('categories', $categories);
        }

        return redirect()->route('admin.post.index')
            ->with('message', Lang::get('notification-message.NOT_FOUND', ['model' => "Post with $id "]))
            ->with('success', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostRequest  $request
     *
     * return Illuminate\Support\Facades\Response
     */
    public function update(PostRequest $request, string $id)
    {
        $subContentList = json_decode($request->content);
        $content = [];
        $dataUpdate = collect($request->only(['title', 'content_title']));

        foreach ($subContentList as $contentItem) {
            $imagePath = $contentItem->image;
            if ($contentItem->type == TypeImage::BASE64) {
                $imagePath = FileHelpers::uploadFileBase64ToPublic($contentItem->image);
            }

            $data = [
                'image' => $imagePath,
                'content' => $contentItem->content,
            ];
            array_push($content, $data);
        }
        //when update post then image title may or may not change
        if ($request->hasFile('image_title')) {

            $image = FileHelpers::uploadImageToPublic($request->file('image_title'));
            if (! $image) {
                return Response::json([
                    'success' => false,
                    'message' => Lang::get('notification-message.FILE_MOVE_ERROR'),
                ]);
            } else {
                $dataUpdate = $dataUpdate->merge([
                    'image_title' => $image,
                ]);
            }
        }

        $dataUpdate = $dataUpdate->merge([
            'content' => json_encode($content),
            'category_id' => $request->category,
        ])
            ->toArray();

        if ($this->postRepository->update($id, $dataUpdate)) {
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->postRepository->destroy($id)) {
            return redirect()->route('admin.post.index')
                ->with('message', Lang::get('notification-message.DELETE_SUCESS'))
                ->with('success', true);
        }

        return redirect()->route('admin.post.index')
            ->with('message', Lang::get('notification-message.DELETE_ERROR'))
            ->with('success', false);
    }

    /**
     * Export csv
     *
     * @param  App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportCsv(Request $request)
    {
        $fileName = 'list_post_'.Carbon::now()->format('YmdHis').'.csv';
        $header = [
            'ID',
            'User',
            'Post Title',
            'Post Cotent',
            'Created Date',
            'Updated Date',
        ];
        $headerRespone = [
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Content-Type' => 'text/csv',
        ];

        $postList = null;
        if ($request->has('search')) {
            $postList = $this->postRepository->getByConditions($request->all(), null, true, ['user']);
        } else {
            $postList = $this->postRepository->getAll(null, true, ['user']);
        }
        $postListToExport = collect($postList)->map(function ($post) {
            return [
                'ID' => $post->id,
                'User' => $post->user->name,
                'Post Title' => $post->title,
                'Post Cotent' => $post->content_title,
                'Created Date' => $post->created_at,
                'Updated Date' => $post->updated_at,
            ];
        })->toArray();

        $result = FileHelpers::exportCSVFile($postListToExport, $header);

        if ($result) {
            return response($result, 200, $headerRespone);
        }
    }
}
