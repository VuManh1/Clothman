<?php
 
namespace App\Exceptions\Products;

use Exception;
use Illuminate\Http\Request;

class ProductOutOfStockException extends Exception
{
    public function __construct(string $msg = null)
    {
        parent::__construct($msg ? $msg : "Product out of stock");
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'message' => $this->getMessage()
            ], 500);
        }

        return back()->with('error', $this->getMessage());
    }
}