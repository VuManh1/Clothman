<?php

namespace App\Services\Payment\Interfaces;

use App\DTOs\CheckoutDto;

interface PaymentService {
    public function processPayment(CheckoutDto $checkoutDto): array;
}