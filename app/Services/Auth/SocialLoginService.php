<?php

namespace App\Services\Auth;

use App\DTOs\SocialLoginDto;
use App\Exceptions\Users\UserIsLockedOutException;
use App\Models\User;
use App\Repositories\Interfaces\UserLoginRepository;
use App\Repositories\Interfaces\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialLoginService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserLoginRepository $userLoginRepository
    ) {}

    public function socialLogin(SocialLoginDto $data): User {
        $data->providerName = Str::lower($data->providerName);

        $user = $this->userRepository->findByEmail($data->email);

        if ($user) {
            $userLogin = $this->userLoginRepository->findByProvider($data->providerName, $data->providerKey);

            if (!$userLogin) {
                $this->userLoginRepository->create([
                    'user_id' => $user->id,
                    'provider_name' => $data->providerName,
                    'provider_key' => $data->providerKey,
                ]);
            }
        } else {
            $user = $this->userRepository->create([
                'name' => $data->name,
                'email' => $data->email,
                'email_verified_at' => Carbon::now()
            ]);

            $this->userLoginRepository->create([
                'user_id' => $user->id,
                'provider_name' => $data->providerName,
                'provider_key' => $data->providerKey,
            ]);
        }

        if ($user->is_locked === 1) throw new UserIsLockedOutException();
        
        Auth::login($user);

        return $user;
    }
}
