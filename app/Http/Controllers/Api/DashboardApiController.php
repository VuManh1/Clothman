<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;
use Illuminate\Http\Request;

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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getYearStats(Request $request) {
        $data = $this->dashboardService->getYearStats((int)$request->query('year'));

        return response()->json($data);
    }
}
