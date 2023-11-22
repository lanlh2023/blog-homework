<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FilePath;
use App\Helpers\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Notifications\RegisterNotification;
use Illuminate\Support\Facades\Lang;

class userController extends Controller
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
     * Render screen login-form
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        $pageTitle = 'Login';
        return view('partial.form.login-form', compact('pageTitle'));
    }

    /**
     * Handle check account exists or not
     *
     * @param App\Http\Requests\UserRequest $request
     * @return mixed redirect dashboard | back
     */
    public function checkLogin(UserRequest $request)
    {
        if (Auth::attempt([...$request->only(['email', 'password']), 'deleted_date' => null])) {
            $ridirecTo = 'admin/dashboard';

            if ($request->session()->get('previous_url')) {
                $ridirecTo = $request->session()->get('previous_url');
                $request->session()->forget('previous_url');
            }

            return redirect()->intended($ridirecTo);
        }

        return back()->withErrors(['error' => 'The provided credentials do not match our records.'])
            ->with('success', false);
    }

    /**
     * Remove the authentication information from the user's session
     *
     * @param App\Http\Requests\UserRequest $request
     * @return redirect login
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Render screen register-form
     * @return \Illuminate\Contracts\View\View
     */
    public function register()
    {
        $pageTitle = 'Register';
        return view('partial.form.register-form', compact('pageTitle'));
    }

    /**
     * Registration new user
     * @param App\Http\Requests\RegisterUserRequest $request
     * @return mixed redirect dashboard | back
     */
    public function checkRegister(RegisterUserRequest $request)
    {
        $user = new User;
        $password = Hash::make($request->password);
        $data = collect($request->only(['name', 'email']))
            ->merge([
                'password' => $password,
            ])
            ->toArray();

        $result = $this->userRepository->save($user, $data);

        if ($result) {
            Auth::login($result);
            Auth::user()->notify(new RegisterNotification());

            return redirect()->route('home')
                ->with('message', config('form-notification.REGISTER_SUCESS_MESSAGE'))
                ->with('success', true);
        }

        return redirect()->route('register')
            ->withErrors(['error' => config('form-notification.REGISTER_ERROR_MESSAGE')])
            ->with('success', false);
    }

    /**
     * Check duplicate email in database
     * @param App\Http\Requests\Request $request
     * @return boolean true|false
     */
    public function checkDuplicateEmail(Request $request)
    {
        if (!empty($request->id)) {
            $users = $this->userRepository->getByEmail($request->email, $request->id);
        } else {
            $users = $this->userRepository->getByEmail($request->email);
        }

        return Response::json(!empty($users));
    }

    /**
     * Render screen user list
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pageTitle = 'User List';
        $users = $this->userRepository->getAll();
        $users = $users->onEachSide($users->lastPage());

        return view('admin.user.index')
            ->with('users', $users)
            ->with('pageTitle', $pageTitle);
    }

    /**
     * Render screen user crate
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pageTitle = 'Add User';

        return view('admin.user.add-edit')
            ->with('pageTitle', $pageTitle);
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
            return redirect()->route('admin.user.create')
                ->with('message', Lang::get('notification-message.REGISTER_SUCESS'))
                ->with('success', true);
        }

        return redirect()->route('admin.user.create')
            ->with('message', Lang::get('notification-message.REGISTER_ERROR'))
            ->with('success', false);
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
            return view('admin.user.show')
                ->with('user', $user)
                ->with('pageTitle', $pageTitle);
        }
        return redirect()->route('admin.user.index')
            ->with('message', Lang::get('notification-message.NOT_FOUND', ['model' => "User with $id "]))
            ->with('success', false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return redirect
     */
    public function destroy(string $id)
    {
        $result = $this->userRepository->destroy($id);

        if ($result) {
            return redirect()->route('admin.user.index')
                ->with('message', Lang::get('notification-message.DELETE_SUCESS'))
                ->with('success', true);
        }

        return redirect()->route('admin.user.index')
            ->with('message', Lang::get('notification-message.DELETE_ERROR'))
            ->with('success', false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * redirect| \Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit User';
        $user = $this->userRepository->getById($id);

        if ($user) {
            return view('admin.user.add-edit')
                ->with('user', $user)
                ->with('pageTitle', $pageTitle);
        }

        return redirect()->route('admin.user.index')
            ->with('message', Lang::get('notification-message.NOT_FOUND', ['model' => "User with $id "]))
            ->with('success', false);
    }

    /**
     * Update user by id
     *
     * @param string $id
     * redirect
     */
    public function update(RegisterUserRequest $request, string $id)
    {
        $pageTitle = 'Edit User';
        $password = Hash::make($request->password);
        $data = collect($request->only(['name', 'email']))->merge(['password' => $password]);
        // avatar is optionnal
        if ($request->hasFile('avatar')) {
            $imagePathOfAvatar = File::uploadImageToPublic($request->file('avatar'), FilePath::IMAGE_AVATAR_FOLDER);
            if ($imagePathOfAvatar) {
                $data = $data->merge(['avatar' => $imagePathOfAvatar]);
            }
        }

        $user = $this->userRepository->update($id, $data->toArray());

        if ($user) {
            return redirect()->back()
                ->with('user', $user)
                ->with('message', Lang::get('notification-message.UPDATE_SUCESS'))
                ->with('success', true)
                ->with('pageTitle', $pageTitle);
        }

        return redirect()->route('admin.user.index')
            ->with('message', Lang::get('notification-message.UPDATE_ERROR'))
            ->with('success', false);
    }
}
