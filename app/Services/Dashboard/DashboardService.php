<?php

namespace App\Services\Dashboard;

use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\SaleRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Services\Products\Interfaces\GetProductsService;
use Carbon\Carbon;

class DashboardService {
    public function __construct(
        private SaleRepository $saleRepository,
        private UserRepository $userRepository,
        private OrderRepository $orderRepository,
        private GetProductsService $getProductsService
    ) {}

    /**
     * Get all statistics for admin dashboard page
     */
    public function getDashboardStatistics(): array {
        $today = Carbon::now()->format('Y-m-d');

        $newUsersCount = $this->userRepository->countByCreatedAt($today);
        $newOrdersCount = $this->orderRepository->countByCreatedAt($today);
        $totalIncomeToday = $this->saleRepository->findByDate($today);
        
        $yearlyStats = $this->saleRepository->getYearStats(Carbon::now()->year);
        $yearlyStatsTotal = $yearlyStats->sum('total');

        $topWeekProducts = $this->getProductsService->getTopSellingProducts(10, 'week');

        return [
            'new_users_count' => $newUsersCount,
            'new_orders_count' => $newOrdersCount,
            'total_income_today' => number_format($totalIncomeToday->amount, 0, '.', '.').'đ',
            'yearly_stats' => [
                'total' => number_format($yearlyStatsTotal, 0, '.', '.')."đ",
                'data' => $yearlyStats
            ],
            'top_week_selling_products' => $topWeekProducts
        ];
    }
}