<?php

namespace App\Observers;

use App\Models\Post;
use App\Repositories\RepositoryInterface\SendMailRepositoryInterface;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;

class PostObserver
{
    protected UserRepositoryInterface $userRepository;

    protected SendMailRepositoryInterface $sendMailRepository;

    /**
     * UserController constructor
     */
    public function __construct(UserRepositoryInterface $userRepository, SendMailRepositoryInterface $sendMailRepository)
    {
        $this->userRepository = $userRepository;
        $this->sendMailRepository = $sendMailRepository;
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
    }

    /**
     * Handle the Post "saved" event.
     */
    public function saved(Post $post): void
    {
        $this->sendMailRepository->create(['post_id' => $post->id, 'email' => auth()->user()->email]);
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
