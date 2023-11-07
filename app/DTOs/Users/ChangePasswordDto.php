<?php

namespace App\DTOs\Users;

use Illuminate\Http\Request;

class ChangePasswordDto
{
    public string $oldPassword;
    public string $password;

    public function __construct(string $oldPassword, string $password)
    {
        $this->oldPassword = $oldPassword;
        $this->password = $password;
    }

    /**
     * Map request to ChangePasswordDto object
     */
    public static function fromRequest(Request $request) {
        return new ChangePasswordDto(
            $request->old_password,
            $request->password,
        );
    }
}
