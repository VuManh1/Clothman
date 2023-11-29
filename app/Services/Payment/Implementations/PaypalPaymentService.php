<?php

namespace App\Services\Payment\Implementations;

use App\DTOs\Payment\CreatePaymentDto;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepository;
use App\Services\Payment\Interfaces\PaymentService;
use App\Services\Payment\Interfaces\Redirectable;
use Exception;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentService implements PaymentService, Redirectable {
    public function __construct(
        private PaymentRepository $paymentRepository
    ) {
    }

    public function createPaymentUrl(int $amount): string {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('checkout.paypal.success'),
                "cancel_url" => route('checkout.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }

            throw new Exception();
        } else {
            throw new Exception();
        }
    }

    public function executePayment(string $token): bool {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return true;
        } else {
            return false;
        }
    }

    public function createPayment(CreatePaymentDto $data): Payment {
        return $this->paymentRepository->create([
            'amount' => $data->amount,
            'payment_method' => "paypal",
            'transaction_id' => $data->transactionId,
            'payer_id' => $data->payerId,
            'currency' => $data->currency,
            'status' => $data->status,
        ]);
    }
}