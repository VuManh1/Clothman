<?php

namespace App\Repositories\Implementations;

use App\DTOs\Orders\OrderParamsDto;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentOrderRepository extends EloquentRepository implements OrderRepository
{
    public function __construct() {
        parent::__construct(Order::class);
    }

    public function findByParams(OrderParamsDto $params): LengthAwarePaginator {
        $query = $this->model->query();

        $query->with('payment');

        if ($params->status) {
            $query->where('status', $params->status);
        }
        if ($params->paymentMethod) {
            $query->whereRelation('payment', 'payment_method', $params->paymentMethod);
        }

        if ($params->sortColumn) {
            $query->orderBy($params->sortColumn, $params->sortOrder ?? "asc");
        }

        return $this->toPaginator($query, $params->page, $params->limit);
    }

    public function findByCode(string $code, array $includes = null): ?Order {
        if ($includes) {
            return $this->model->with($includes)->where('code', $code)->first();
        }

        return $this->model->where('code', $code)->first();
    }

    public function findByUserId(string $userId, int $page, int $limit, array $includes = null): LengthAwarePaginator {
        $query = $this->model->query();

        if ($includes) $query->with($includes);

        $query->where('user_id', $userId)->orderBy('created_at', 'desc');

        return $this->toPaginator($query, $page, $limit);
    }

    public function countByCreatedAt(string $date): int {
        return $this->model->whereDate('created_at', $date)->count();
    }
}
