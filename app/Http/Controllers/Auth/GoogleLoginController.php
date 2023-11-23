<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\SocialLoginDto;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\SocialLoginService;
use App\Utils\Role;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function __construct(
        private SocialLoginService $socialLoginService
    ) {
        
    }

    /**
     * Redirect to google login screen
     */
    public function google() {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle google redirect callback
     */
    public function redirect() {
        $googleUser = Socialite::driver('google')->user();

        $dto = new SocialLoginDto();
        $dto->email = $googleUser->email;
        $dto->name = $googleUser->name;
        $dto->providerKey = $googleUser->id;
        $dto->providerName = 'google';

        $user = $this->socialLoginService->socialLogin($dto);

        if ($user->role === Role::ADMIN || $user->role === Role::STAFF) {
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
