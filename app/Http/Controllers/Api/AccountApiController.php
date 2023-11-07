<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\UpdateUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Services\Users\Interfaces\ManageUsersService;
use Illuminate\Support\Facades\Auth;

class AccountApiController extends Controller
{
    public function __construct(
        private ManageUsersService $manageUsersService
    ) {}

    /**
     * Handle update account information
     */
    public function updateInfor(UpdateAccountRequest $request) {
        $request->validated();

        $userId = Auth::id();
        $updateUserDto = UpdateUserDto::fromRequest($request);
        
        $user = $this->manageUsersService->updateUserInformation($userId, $updateUserDto);

        return response()->json($user, 200);
    }

    /**
     * Handle change password
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
