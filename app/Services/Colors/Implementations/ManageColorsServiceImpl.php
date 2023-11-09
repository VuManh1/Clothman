<?php

namespace App\Services\Colors\Implementations;

use App\DTOs\Colors\CreateColorDto;
use App\DTOs\Colors\UpdateColorDto;
use App\Exceptions\Colors\ColorDuplicateException;
use App\Repositories\Interfaces\ColorRepository;
use App\Services\Colors\Interfaces\ManageColorsService;
use App\Models\Color;

class ManageColorsServiceImpl implements ManageColorsService
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {}

    public function createColor(CreateColorDto $createColorDto): Color {
        try {
            return $this->colorRepository->create([
                "name"=> $createColorDto->name,
                "hex_code"=> $createColorDto->hex_code,
            ]);
        } catch (\Illuminate\Database\QueryException $th) {
            throw new ColorDuplicateException();
        }
    }

    public function updateColor($id, UpdateColorDto $updateColorDto): Color {
        $data = [
            "name"=> $updateColorDto->name,
            "hex_code"=> $updateColorDto->hex_code,
        ];

        try {
            return $this->colorRepository->update($id, $data);
        } catch (\Illuminate\Database\QueryException $th) {
            throw new ColorDuplicateException();
        }
    }


    public function deleteColor($id): bool {
        return $this->colorRepository->delete($id);
    }
}
