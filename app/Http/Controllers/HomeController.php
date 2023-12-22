<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

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

    /**
     * Render screen blog detail
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        $pageTitle = 'Blog detail';
        $post = $this->postRepository->getById($id);
        if ($post) {
            return view('blog.show')
                ->with('post', $post)
                ->with('pageTitle', $pageTitle);
        }
        return redirect()->route('home')
            ->with('message', Lang::get('notification-message.NOT_FOUND', ['model' => "Blog with $id "]))
            ->with('success', false);
    }

    /**
     *
     *
     * @param string $name
     * @return \Illuminate\Contracts\View\View
     */
    public function loadByCategory(string $categoryName)
    {
        $pageTitle = 'Blog';
        $posts = $this->postRepository->getByCategory(10, true, null, strtoupper($categoryName));

        if ($posts) {
            return view('blog.index')
                ->with('posts', $posts)
                ->with('pageTitle', $pageTitle)
                ->with('categoryName', ucfirst($categoryName));
        }
    }
}
