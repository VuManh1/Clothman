<?php

namespace App\Services\Checkout\Interfaces;

use App\DTOs\CheckoutDto;

interface CheckoutService {
    public function processCheckout(CheckoutDto $data);
}