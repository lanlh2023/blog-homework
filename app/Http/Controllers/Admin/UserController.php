<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
       
            if($request->session()->get('previous_url')) {
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
}