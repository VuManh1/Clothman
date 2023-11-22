<?php

namespace App\DTOs\Orders;

class CreateOrderDto
{
    public ?string $userId;
    public string $paymentId;
    public string $status;
    public string $customerName;
    public string $email;
    public string $phoneNumber;
    public string $address;
    public ?string $note;
    public array $orderItems;
}