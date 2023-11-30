<?php

namespace App\Services\Payment\Interfaces;

use App\DTOs\CheckoutDto;
use App\DTOs\Payment\CreatePaymentDto;
use App\Models\Payment;

interface PaymentService {
    public function processPayment(CheckoutDto $checkoutDto): array;
}