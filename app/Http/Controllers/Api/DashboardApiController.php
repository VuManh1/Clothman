<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Statistic\StatisticService;

class DashboardApiController extends Controller
{
    public function __construct(
        private StatisticService $statisticService
    ) {
        
    }

    /**
     * Get dashboard information
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboard() {
        $data = $this->statisticService->getDashboardStatistics();

        return response()->json([
            'data' => $data
        ]);
    }
}
