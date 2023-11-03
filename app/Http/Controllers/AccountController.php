<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
    /**
     * Display account info page
     */
    public function infor() {
        return view("account.infor");
    }
}
