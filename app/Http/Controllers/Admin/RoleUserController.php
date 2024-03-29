<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleUserRequest;
use App\Repositories\RepositoryInterface\RoleRepositoryInterface;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class RoleUserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    protected RoleRepositoryInterface $roleRepostiory;

    /**
     * UserController constructor
     */
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepostiory)
    {
        $this->userRepository = $userRepository;
        $this->roleRepostiory = $roleRepostiory;
    }

    /**
     * Render screen user and role of user
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pageTitle = 'Role User';
        $users = $this->userRepository->getAll();
        $users = $users->onEachSide($users->lastPage());
        $roles = $this->roleRepostiory->getAll(null, false);

        return view('admin.role_user.index')
            ->with('users', $users)
            ->with('roles', $roles)
            ->with('pageTitle', $pageTitle);
    }

    /**
     * Set role for user
     *
     * @return mixed array
     */
    public function store(RoleUserRequest $request)
    {
        if ($this->userRepository->update($request->userId, ['role_id' => $request->roleId])) {
            return Response::json([
                'success' => true,
                'message' => Lang::get('notification-message.SET_ROLE_SUCCESS'),
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => Lang::get('notification-message.SET_ROLE_ERROR'),
        ]);
    }
}
