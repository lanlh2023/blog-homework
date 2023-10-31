<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
