<?php

namespace App\Services\Statistic;

use App\Repositories\Interfaces\OrderRepository;
use App\Repositories\Interfaces\SaleRepository;
use App\Repositories\Interfaces\UserRepository;
use Carbon\Carbon;

class StatisticService {
    public function __construct(
        private SaleRepository $saleRepository,
        private UserRepository $userRepository,
        private OrderRepository $orderRepository
    ) {}

    /**
     * Get all statistics for admin dashboard page
     */
    public function getDashboardStatistics(): array {
        $newUsersCount = $this->userRepository->countByCreatedAt(Carbon::now()->format('Y-m-d'));
        $newOrdersCount = $this->orderRepository->countByCreatedAt(Carbon::now()->format('Y-m-d'));
        
        $yearlyStats = $this->saleRepository->getYearlyStats(Carbon::now()->year);
        $yearlyStatsTotal = $yearlyStats->sum('total');

        return [
            'new_users_count' => $newUsersCount,
            'new_orders_count' => $newOrdersCount,
            'yearly_stats' => [
                'total' => number_format($yearlyStatsTotal, 0, '.', '.')."đ",
                'data' => $yearlyStats
            ]
        ];
    }
}