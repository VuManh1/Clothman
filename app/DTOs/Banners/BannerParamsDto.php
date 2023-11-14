<?php

namespace App\DTOs\Banners;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class BannerParamsDto extends QueryParamsDto
{
    public function __construct(
        public int $page,
        public int $limit,
        public ?string $sort,
        public ?string $by,
        public ?string $keyword
    ) {
        parent::__construct($page, $limit, $sort, $by, $keyword);
    }

    /**
     * Map request to BannerParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new BannerParamsDto(
            $paramsDto->page,
            $paramsDto->limit,
            $paramsDto->sort,
            $paramsDto->by,
            $paramsDto->keyword,
        );
    }
}
