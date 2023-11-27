<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Users\Interfaces\ManageUsersService;
use Illuminate\Http\Request;

use App\DTOs\Users\ChangePasswordDto;
use App\DTOs\Users\CreateStaffDto;
use App\DTOs\Users\UpdateUserDto;
use App\DTOs\Users\UserParamsDto;
use App\Http\Requests\Account\CreateStaffRequest;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Services\Users\Interfaces\GetUsersService;
use App\Services\Users\Implementations\GetUsersServiceImpl;

class UsersController extends Controller
{
    public function __construct(
        private ManageUsersService $manageUsersService,
        private GetUsersService $getUsersService
    ) {
        $this->middleware('role:ADMIN,null,null')->only(['destroy']);
    }

    public function index(Request $request){
        $params = UserParamsDto::fromRequest($request);
        $users = $this->getUsersService->getUsersByParams($params);
        $this->appendPaginatorURL( $users);
        return view('admin.users.index', ['users'=> $users]);
    }
    public function create()
    {
        return view("admin.users.create");
    }

    public function edit($id)
    {
        $user = $this->getUsersService->getUserById($id);

        return view("admin.users.edit", compact("user"));
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        $updateUserDto = UpdateUserDto::fromRequest($request);

        $user = $this->manageUsersService->updateUserInformation($id, $updateUserDto);

        return redirect()->route("admin.users.index")->with("success", $user->name." updated !");
    }

    // public function destroy($id)
    // {
    //     $this->manageUsersService->deleteUser($id);

    //     return redirect()->route("admin.users.index")->with("success", "user deleted !");
    // }


}
