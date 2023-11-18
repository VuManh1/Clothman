<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Colors\ColorParamsDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Colors\Interfaces\GetColorsService;

class ColorsApiController extends Controller
{
    public function __construct(
        private GetColorsService $getColorsService,
    ) {
    }

    /**
     * Return a listing of color.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getColors(Request $request)
    {
        $params = ColorParamsDto::fromRequest($request);
        $colors = $this->getColorsService->getColorsByParams($params);

        return response()->json($colors);
    }
}
