<?php

namespace App\DTOs\Products;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class ProductParamsDto extends QueryParamsDto
{
    public function __construct(
        public int $page,
        public int $limit,
        public ?string $sort,
        public ?string $by,
        public ?string $keyword,
        public ?string $category,
        public ?array $includes,
    ) {
        parent::__construct($page, $limit, $sort, $by, $keyword);
    }

    /**
     * Map request to CategoryParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new ProductParamsDto(
            $paramsDto->page,
            $paramsDto->limit,
            $paramsDto->sort,
            $paramsDto->by,
            $paramsDto->keyword,
            $request->query('category'),
            null,
        );
    }
}
