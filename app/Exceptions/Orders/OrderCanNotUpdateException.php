<?php
 
namespace App\Exceptions\Orders;

use Exception;
use Illuminate\Http\Request;

class OrderCanNotUpdateException extends Exception
{
    public function __construct($msg)
    {
        parent::__construct($msg);
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'message' => $this->getMessage()
            ], 403);
        }

        return back()->with('error', $this->getMessage());
    }
}