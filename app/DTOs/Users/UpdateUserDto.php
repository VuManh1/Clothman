<?php

namespace App\DTOs\Users;

use Illuminate\Http\Request;

class UpdateUserDto
{
    public string $name;
    public string $phoneNumber;
    public ?string $address;

    public function __construct(string $name, string $phoneNumber, ?string $address)
    {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
    }

    /**
     * Map request to UpdateUserDto object
     */
    public static function fromRequest(Request $request) {
        return new UpdateUserDto(
            $request->name,
            $request->phonenumber,
            $request->address
        );
    }
}
