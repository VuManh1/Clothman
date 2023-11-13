<?php
 
namespace App\Exceptions\Categories;

use Exception;
use Illuminate\Http\Request;

/**
 * Exception thrown if trying to delete a category which have at least one child category
 */
class CategoryCanNotDeleteException extends Exception
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