<?php

namespace App\DTOs\Categories;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class CategoryParamsDto extends QueryParamsDto
{
    public function __construct(
        public int $limit,
        public ?string $sort,
        public ?string $by,
        public ?string $keyword
    ) {
        parent::__construct($limit, $sort, $by, $keyword);
    }

    /**
     * Map request to CategoryParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new CategoryParamsDto(
            $paramsDto->limit,
            $paramsDto->sort,
            $paramsDto->by,
            $paramsDto->keyword,
        );
    }
}
