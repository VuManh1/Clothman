<?php

namespace App\DTOs\Products;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class ProductParamsDto extends QueryParamsDto
{
    public function __construct(
        int $page,
        int $limit,
        ?string $sortColumn,
        ?string $sortOrder,
        ?string $keyword,
        public ?string $category,
        public ?array $includes,
    ) {
        parent::__construct($page, $limit, $sortColumn, $sortOrder, $keyword);
    }

    /**
     * Map request to CategoryParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new ProductParamsDto(
            $paramsDto->page,
            $paramsDto->limit,
            $paramsDto->sortColumn,
            $paramsDto->sortOrder,
            $paramsDto->keyword,
            $request->query('category'),
            null,
        );
    }
}
