<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Carbon\Carbon;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

    public function imageUpload(UploadedFile $file)
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subContentList = json_decode($request->content);
        $content = '';

        foreach ($subContentList as $contentItem) {
            $imagePath = FileHelpers::uploadFileBase64ToPublic($contentItem->imagePath);

            if ($imagePath) {
                $content .= FileHelpers::createNewTagImage($imagePath);
                $content .= "<div>$contentItem->content</div>";
            }
        }

        $file = $request->file('image_title');
        if (!$file) {
            return Response::json([
                'success' => false,
                'message' => Lang::get('notification-message.FILE_UPLOAD_ERROR'),
            ]);
        }

        $pathInfo = pathinfo($file->getClientOriginalName());
        $fileName = $pathInfo['filename'];
        $extension = $pathInfo['extension'];
        $fileName = $fileName . '_' . Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHisu') . '.' . $extension;

        $path = $file->move(public_path('images/post_title'), $fileName);
        if (!$path) {
            return Response::json([
                'success' => false,
                'message' => Lang::get('notification-message.FILE_MOVE_ERROR'),
            ]);
        }

        $data = collect($request->only(['title', 'content_title']))
            ->merge([
                'image_title' => 'iamges/post_title' . $fileName,
                'content' => $content,
            ])
            ->toArray();

        $result = $this->postRepository->create($data);

        if ($result) {
            return Response::json([
                'success' => true,
                'message' => Lang::get('notification-message.REGISTER_SUCESS'),
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => Lang::get('notification-message.REGISTER_ERROR'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
