<?php
 
namespace App\Exceptions\Users;
 
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordNotMatchException extends Exception
{
    public function __construct()
    {
        parent::__construct("Mật khẩu không khớp");
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $this->getMessage()
            ], 400);
        }
    
        return false;
    }
}