<?php

namespace App\DTOs\Users;

use App\DTOs\Common\QueryParamsDto;
use Illuminate\Http\Request;

class UserParamsDto extends QueryParamsDto
{
    public function __construct(
        int $page,
        int $limit,
        ?string $sortColumn,
        ?string $sortOrder,
        ?string $keyword,
        public ?bool $isLocked,
        public ?string $role,
    ) {
        parent::__construct($page, $limit, $sortColumn, $sortOrder, $keyword);
    }

    /**
     * Map request to UserParamsDto object
     */
    public static function fromRequest(Request $request) {
        $paramsDto = QueryParamsDto::fromRequest($request);

        return new UserParamsDto(
            $paramsDto->page,
            $paramsDto->limit,
            $paramsDto->sortColumn,
            $paramsDto->sortOrder,
            $paramsDto->keyword,
            $request->is_locked,
            $request->role,
        );
    }
}
