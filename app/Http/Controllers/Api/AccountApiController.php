<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Users\UpdateUserDto;
use App\Http\Controllers\Controller;
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
    public function update(UpdateAccountRequest $request) {
        $request->validated();

        $userId = Auth::id();
        $updateUserDto = UpdateUserDto::fromRequest($request);
        
        $user = $this->manageUsersService->updateUserInformation($userId, $updateUserDto);

        return response()->json($user, 200);
    }
}
