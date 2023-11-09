<?php

namespace App\Services\Colors\Implementations;

use App\Repositories\Interfaces\ColorRepository;
use App\Services\Colors\Interfaces\GetColorsService;
use App\DTOs\Colors\ColorParamsDto;
use App\Exceptions\Colors\ColorNotFoundException;
use App\Models\Color;

class GetColorsServiceImpl implements GetColorsService
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {}

    public function getColors(ColorParamsDto $params = null) {
        if (!$params) {
            return $this->colorRepository->getAll();
        }

        $filters = null;
        if ($params->keyword) {
            $filters = [
                'column' => 'name',
                'operator' => 'LIKE',
                'value' => '%'.$params->keyword.'%'
            ];
        }

        $sorts = null;
        if ($params->sort) {
            $sorts = ['column' => $params->sort, 'by' => $params->by];
        }

        $colors = $this->colorRepository->find(
            $params->page,
            $params->limit,
            $filters,
            $sorts
        );

        return $colors;
    }

    public function getColorById(string $id): Color {
        $color = $this->colorRepository->findById($id);

        if (!$color) throw new ColorNotFoundException();

        return $color;
    }
}
