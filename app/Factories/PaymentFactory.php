<?php

namespace App\Factories;

use App\Services\Payment\Implementations\CodPaymentService;
use App\Services\Payment\Implementations\PaypalPaymentService;
use App\Services\Payment\Interfaces\PaymentService;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class PaymentFactory {
    public function createPayment(string $paymentMethod): PaymentService {
        switch ($paymentMethod)
        {
            case "COD":
                return App::make(CodPaymentService::class);
            case "paypal":
                return App::make(PaypalPaymentService::class);
            default:
                throw new InvalidArgumentException();
        }
    }
}