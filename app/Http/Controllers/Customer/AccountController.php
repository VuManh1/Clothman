<?php

namespace App\Http\Controllers\Customer;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\UpdateUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Services\Users\Interfaces\ManageUsersService;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct(
        private ManageUsersService $manageUsersService
    ) {}

    /**
     * Display account info page
     */
    public function infor() {
        return view("account.infor", ["page" => "infor"]);
    }

    /**
     * Handle update account information
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateInfor(UpdateAccountRequest $request) {
        $request->validated();

        $userId = Auth::id();
        $updateUserDto = UpdateUserDto::fromRequest($request);
        
        $user = $this->manageUsersService->updateUserInformation($userId, $updateUserDto);

        return response()->json($user, 200);
    }

    /**
     * Display password page
     */
    public function password() {
        return view("account.password", ["page" => "password"]);
    }

    /**
     * Handle change password
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request) {
        $request->validated();

        $userId = Auth::id();
        $changePwDto = ChangePasswordDto::fromRequest($request);
        
        $this->manageUsersService->changePassword($userId, $changePwDto);

        return response()->json([
            'success' => true,
            'message' => "Cập nhập mật khẩu thành công"
        ]);
    }
}
