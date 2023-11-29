<?php

namespace App\Services\Payment\Interfaces;

/**
 * Interface for payment need to redirect to another page
 */
interface Redirectable {
    public function createPaymentUrl(int $amount): string;
}