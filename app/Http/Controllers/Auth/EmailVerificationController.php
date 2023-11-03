<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    /**
     * Display the verify email view.
     */
    public function notice() {
        if (Auth::user()->email_verified_at) {
            return redirect(RouteServiceProvider::HOME);
        }

        return view("auth.verify-email");
    }

    /**
     * Handle verify email
     */
    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Handle resend the verification email
     */
    public function send(Request $request) {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with('success', 'Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.');
    }
}
