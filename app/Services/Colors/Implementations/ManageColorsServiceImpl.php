<?php

namespace App\Services\Colors\Implementations;

use App\DTOs\Colors\CreateColorDto;
use App\Repositories\Interfaces\ColorRepository;
use App\Services\Colors\Interfaces\ManageColorsService;


class ManageColorsServiceImpl implements ManageColorsService
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {}

    public function createColor(CreateColorDto $createColorDto) {
        return $this->colorRepository->create([
            "name"=> $createColorDto->name,
            "hex_code"=> $createColorDto->hex_code,
        ]);
    }


}
