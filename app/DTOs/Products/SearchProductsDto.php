<?php

namespace App\DTOs\Products;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class SearchProductsDto
{
    public function __construct(
        public int $page,
        public int $limit,
        public ?string $keyword,
        public ?string $category,
    ) {
    }

    /**
     * Map request to SearchProductsDto object
     */
    public static function fromRequest(Request $request) {
        return new SearchProductsDto(
            $request->page ?? 1,
            25,
            $request->query('q'),
            $request->query('category'),
        );
    }
}
