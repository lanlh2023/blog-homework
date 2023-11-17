<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RepositoryInterface\RoleRepositoryInterface;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    protected RoleRepositoryInterface $roleRepostiory;

    /**
     * UserController constructor
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepostiory)
    {
        $this->userRepository = $userRepository;
        $this->roleRepostiory = $roleRepostiory;
    }

    public function index() {
        $pageTitle = 'Role User';
        $users = $this->userRepository->getAll();
        $users = $users->onEachSide($users->lastPage());
        $roles = $this->roleRepostiory->getAll(null, false);

        return view('admin.role_user.index')
            ->with('users', $users)
            ->with('roles', $roles)
            ->with('pageTitle', $pageTitle);
    }

    public function create() {

    }

    public function store() {

    }
}
