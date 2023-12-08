<?php

namespace App\Http\Controllers\Api;

use App\Enums\FilePath;
use App\Helpers\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserCollection;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

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
     * Get collection user
     *
     * @return UserCollection
     */
    public function index()
    {
        $users = $this->userRepository->getAll();
        $users = $users->onEachSide($users->lastPage());

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterUserRequest $request
     * @return mixed array
     */
    public function store(RegisterUserRequest $request)
    {
        $password = Hash::make($request->password);
        $data = collect($request->only(['name', 'email']))->merge(['password' => $password]);
        // avatar is optionnal
        if ($request->hasFile('avatar')) {
            $imagePathOfAvatar = File::uploadImageToPublic($request->file('avatar'), FilePath::IMAGE_AVATAR_FOLDER);
            if ($imagePathOfAvatar) {
                $data = $data->merge(['avatar' => $imagePathOfAvatar]);
            }
        }

        if ($this->userRepository->create($data->toArray())) {
            return response()->json([
                'message' => Lang::get('notification-message.REGISTER_SUCESS'),
                'success' => true
            ], 200);
        }

        return response()->json([
            'message' => Lang::get('notification-message.REGISTER_ERROR'),
            'success' => false
        ], 500);
    }

     /**
     * Display the specified resource.
     *
     * @param string $id
     * @return redirect| \Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        $pageTitle = 'User show';
        $user = $this->userRepository->getById($id);
        if ($user) {
            return response()->json([
                'user' => $user,
                'success' => true,
                'pageTitle'=> $pageTitle
            ], 200);
        }

        return response()->json([
            'success' => false,
            'pageTitle' => $pageTitle
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return redirect
     */
    public function destroy(string $id)
    {
        if ($this->userRepository->destroy($id)) {
            return response()->json([
                'message' => Lang::get('notification-message.DELETE_SUCESS'),
                'success' => true
            ]);
        }

        return response()->json([
            'message' => Lang::get('notification-message.DELETE_ERROR'),
            'success' => true
        ]);
    }
}
