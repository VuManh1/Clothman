<?php

namespace App\DTOs\Orders;

use Illuminate\Http\Request;

class UpdateOrderDto
{
    public string $address;
    public string $status;

    public static function fromRequest(Request $request) {
        $dto = new UpdateOrderDto();
        $dto->address = $request->address;
        $dto->status = $request->status;

        return $dto;
    }
}