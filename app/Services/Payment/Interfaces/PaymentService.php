<?php

namespace App\Services\Payment\Interfaces;

use App\DTOs\Payment\CreatePaymentDto;
use App\Models\Payment;

interface PaymentService {
    public function createPayment(CreatePaymentDto $data): Payment;
}