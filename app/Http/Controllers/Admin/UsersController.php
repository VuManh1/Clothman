<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Users\Interfaces\ManageUsersService;
use App\DTOs\Users\CreateStaffDto;
use App\DTOs\Users\UserParamsDto;
use App\Http\Requests\Users\CreateStaffRequest;
use App\Services\Users\Interfaces\GetUsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(
        private ManageUsersService $manageUsersService,
        private GetUsersService $getUsersService
    ) {

    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $params = UserParamsDto::fromRequest($request);

        $users = $this->getUsersService->getUsersByParams($params);
        
        $this->appendPaginatorURL( $users);
        
        return view('admin.users.index', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created staff in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStaffRequest $request) {
        $dto = CreateStaffDto::fromRequest($request);

        $this->manageUsersService->createStaff($dto);

        return redirect()->route('admin.users.index')->with('success', 'Staff created !');
    }

    public function show($id)
    {
        $user = $this->getUsersService->getUserById($id);

        return view("admin.users.show", compact("user"));
    }

    public function lock($id)
    {
        $locked = $this->manageUsersService->toggleLock($id);

        return response()->json([
            'status' => 'success',
            'message' => $locked ? "Locked successfully" : "Unlocked successfully"
        ]);
    }
}
