<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;

class DashboardApiController extends Controller
{
    public function __construct(
        private DashboardService $dashboardService
    ) {
        
    }

    /**
     * Get dashboard information
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboard() {
        $data = $this->dashboardService->getDashboardStatistics();

        return response()->json([
            'data' => $data
        ]);
    }
}
