<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard view
     */
    public function dashboard() {
        return view("admin.dashboard");
    }
}
