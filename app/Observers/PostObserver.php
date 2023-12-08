<?php

namespace App\Observers;

use App\Mail\SendMailForUpdatePost;
use App\Models\Post;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class PostObserver
{
    protected UserRepositoryInterface $userRepository;

    /**
     * UserController constructor
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        $post->user_id = auth()->user()->id;
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // TODO: get list admins after merge feature manger role
        $admins = ['admin@gmail.com', 'admin2@gmail.com'];

        foreach ($admins as $recipient) {
            Mail::to($recipient)->send(new SendMailForUpdatePost($post));
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
