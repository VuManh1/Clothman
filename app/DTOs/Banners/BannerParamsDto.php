<?php

namespace App\DTOs\Banners;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class BannerParamsDto extends QueryParamsDto
{
    public function __construct(
        int $page,
        int $limit,
        ?string $sortColumn,
        ?string $sortOrder,
        ?string $keyword,
        public ?bool $isActive
    ) {
        parent::__construct($page, $limit, $sortColumn, $sortOrder, $keyword);
    }

    /**
     * Map request to BannerParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new BannerParamsDto(
            $paramsDto->page,
            $paramsDto->limit,
            $paramsDto->sortColumn,
            $paramsDto->sortOrder,
            $paramsDto->keyword,
            $request->is_active
        );
    }
}
