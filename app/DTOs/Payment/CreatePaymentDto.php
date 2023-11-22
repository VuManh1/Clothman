<?php

namespace App\DTOs\Payment;

class CreatePaymentDto
{
    public int $amount;
    public string $paymentMethod;
    public ?string $transactionId = null;
    public ?string $payerId = null;
    public string $currency;
    public string $status;
}