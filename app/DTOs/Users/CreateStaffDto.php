<?php

namespace App\DTOs\Users;

use Illuminate\Http\Request;

class CreateStaffDto
{
    public function __construct(

        public string $name,
        public ?string $email,
        public ?string $address,
        public int $phone_number,
        public string $password,
        public string $role,
    ) {}

    /**
     * Map request to CreateStaffDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name,
            $request->email,
            $request->address,
            $request->phone_number,
            $request->password,
            $request->role,
        );
    }
}
