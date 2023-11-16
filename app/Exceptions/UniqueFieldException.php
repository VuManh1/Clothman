<?php
 
namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

/**
 * Exception thrown if trying to insert a unique field to database
 */
class UniqueFieldException extends Exception
{
    public function __construct()
    {
        parent::__construct("Unique field constraint violation");
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'message' => $this->getMessage()
            ], 400);
        }

        return back()->with('error', $this->getMessage())->withInput($request->input());
    }
}