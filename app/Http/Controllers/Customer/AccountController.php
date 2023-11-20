<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Display account info page
     */
    public function infor() {
        return view("account.infor", ["page" => "infor"]);
    }

    /**
     * Display account password page
     */
    public function password() {
        return view("account.password", ["page" => "password"]);
    }
}
