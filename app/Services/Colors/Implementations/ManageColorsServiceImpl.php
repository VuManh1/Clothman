<?php

namespace App\Services\Colors\Implementations;

use App\DTOs\Colors\CreateColorDto;
use App\DTOs\Colors\UpdateColorDto;
use App\Repositories\Interfaces\ColorRepository;
use App\Services\Colors\Interfaces\ManageColorsService;
use App\DTOs\Colors\ColorParamsDto;
use App\Exceptions\Colors\ColorNotFoundException;
use App\Models\Color;
use Error;
use Illuminate\Support\Str;


class ManageColorsServiceImpl implements ManageColorsService
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {}

    public function createColor(CreateColorDto $createColorDto): Color {
            return $this->colorRepository->create([
                "name"=> $createColorDto->name,
                "hex_code"=> $createColorDto->hex_code,
            ]);

    }

    public function updateColor($id, UpdateColorDto $updateColorDto): Color {
        $data = [
            "name"=> $updateColorDto->name,
            "hex_code"=> $updateColorDto->hex_code,
        ];

        return $this->colorRepository->update($id, $data);
    }


    public function deleteColor($id): bool {
        return $this->colorRepository->delete($id);
    }


}
