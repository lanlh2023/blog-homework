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
    const PAGINATION = 10;
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
        $users = $this->userRepository->getAll(self::PAGINATION, true, ['role']);
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
}
