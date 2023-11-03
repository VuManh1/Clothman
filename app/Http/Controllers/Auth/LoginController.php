<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Utils\Role;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Display the login view.
     */
    public function login() {
        return view("auth.login");
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(LoginRequest $request) {
        $request->validated();
 
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            $user = Auth::user();

            // check if user is locked
            if ($user->is_locked === 1) {
                Auth::logout();
 
                return back()->withErrors([
                    'Tài khoản của bạn đang bị khóa.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
 
            if ($user->role === Role::ADMIN || $user->role === Role::STAFF) {
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        }
 
        return back()->withErrors([
            'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(RouteServiceProvider::HOME);
    }
}
