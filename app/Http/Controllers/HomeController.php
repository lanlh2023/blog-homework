<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Render screen blog home
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pageTitle = 'Blog';
        $posts = $this->postRepository->getAll();
        $posts = $posts->onEachSide($posts->lastPage());

        return view('blog.index')
            ->with('posts', $posts)
            ->with('pageTitle', $pageTitle);
    }
}
