<?php
 
namespace App\Exceptions\Products;

use Exception;
use Illuminate\Http\Request;

/**
 * Exception thrown if trying to delete a product which have at least one order
 */
class ProductCanNotDeleteException extends Exception
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
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $this->getMessage()
            ], 400);
        }

        return back()->with('error', $this->getMessage());
    }
}