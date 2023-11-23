<?php
 
namespace App\Exceptions\Users;
 
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIsLockedOutException extends Exception
{
    public function __construct()
    {
        parent::__construct("Tài khoản của bạn đang bị khóa.");
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        Auth::logout();
        
        if ($request->ajax()) {
            return response()->json([
                'message' => $this->getMessage()
            ], 403);
        }
    
        return redirect()->route('login')->withErrors([
            $this->getMessage(),
        ])->onlyInput('email');
    }
}