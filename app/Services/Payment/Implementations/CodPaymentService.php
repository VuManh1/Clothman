<?php

namespace App\Services\Payment\Implementations;

use App\DTOs\Payment\CreatePaymentDto;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepository;
use App\Services\Payment\Interfaces\PaymentService;

class CodPaymentService implements PaymentService {
    public function __construct(
        private PaymentRepository $paymentRepository
    ) {
    }

    public function createPayment(CreatePaymentDto $data): Payment {
        return $this->paymentRepository->create([
            'amount' => $data->amount,
            'payment_method' => "COD",
            'transaction_id' => $data->transactionId,
            'payer_id' => $data->payerId,
            'currency' => $data->currency,
            'status' => $data->status,
        ]);
    }
}