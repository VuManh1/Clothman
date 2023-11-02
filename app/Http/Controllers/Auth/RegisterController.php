<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Display the registration view.
     */
    public function register() {
        return view("auth.register");
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(RegisterRequest $request)
    {
        $request->validated();
        
        try {
            Auth::login($user = User::create([
                'name' => $request->name,
                'phonenumber' => $request->phonenumber,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]));
        } catch (\Illuminate\Database\QueryException $th) {
            return back()->withErrors([
                'Email đã tồn tại',
            ])->onlyInput(['name', 'email', 'phonenumber']);
        }

        event(new Registered($user));

        return redirect(route("verification.notice"));
    }
}
