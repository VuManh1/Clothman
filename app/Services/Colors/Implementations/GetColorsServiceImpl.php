<?php

namespace App\Services\Colors\Implementations;

use App\Repositories\Interfaces\ColorRepository;
use App\Services\Colors\Interfaces\GetColorsService;
use App\DTOs\Colors\ColorParamsDto;
use App\Exceptions\Colors\ColorNotFoundException;
use App\Models\Color;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetColorsServiceImpl implements GetColorsService
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {}

    public function getAllColors(): Collection {
        return $this->colorRepository->getAll();
    }

    public function getColorsByParams(ColorParamsDto $params): LengthAwarePaginator {
        return $this->colorRepository->findByParams($params);
    }

    public function getColorById(string $id): Color {
        $color = $this->colorRepository->findById($id);

        if (!$color) throw new ColorNotFoundException();

        return $color;
    }
}
