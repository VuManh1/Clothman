<?php

namespace App\Repositories\Implementations;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepository;

class EloquentPaymentRepository extends EloquentRepository implements PaymentRepository
{
    public function __construct() {
        parent::__construct(Payment::class);
    }
}
