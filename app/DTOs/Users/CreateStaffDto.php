<?php

namespace App\DTOs\Users;

use Illuminate\Http\Request;

class CreateStaffDto
{
    public function __construct(

        public string $name,
        public string $email,
        public string $password,
    ) {}

    /**
     * Map request to CreateStaffDto object
     */
    public static function fromRequest(Request $request) {
        return new self(
            $request->name,
            $request->email,
            $request->password,
        );
    }
}
