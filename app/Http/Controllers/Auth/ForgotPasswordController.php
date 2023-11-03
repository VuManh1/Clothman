<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Display forgor password view
     */
    public function request() {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgor password submission
     */
    public function email(Request $request) {
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['success' => __("Chúng tôi đã gửi đường dẫn đặt lại mật khẩu cho bạn, hãy kiểm tra email của bạn")])
                    : back()->withErrors(['email' => __($status)]);
    }
}
