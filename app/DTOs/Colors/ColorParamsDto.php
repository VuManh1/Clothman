<?php

namespace App\DTOs\Colors;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class ColorParamsDto extends QueryParamsDto
{
    public function __construct(
        int $page,
        int $limit,
        ?string $sortColumn,
        ?string $sortOrder,
        ?string $keyword
    ) {
        parent::__construct($page, $limit, $sortColumn, $sortOrder, $keyword);
    }

    /**
     * Map request to ColorParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new ColorParamsDto(
            $paramsDto->page,
            $paramsDto->limit,
            $paramsDto->sortColumn,
            $paramsDto->sortOrder,
            $paramsDto->keyword,
        );
    }
}
