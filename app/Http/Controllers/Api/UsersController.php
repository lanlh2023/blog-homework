<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;

class UsersController extends Controller
{
    /**
     * UserController constructor
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Render screen user list
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = $this->userRepository->getAll();
        $users = $users->onEachSide($users->lastPage());

        return new UserCollection($users);
    }
}
