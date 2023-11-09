<?php

namespace App\Services\Colors\Interfaces;
use App\DTOs\Colors\ColorParamsDto;
use App\Models\Color;

/**
 * Service Interface for color to deal with Read operations
 */
interface GetColorsService
{
    /**
     * Get colors
     * @return mixed
     */
    public function getColors(ColorParamsDto $params = null);

    public function getColorsById(string $id): Color;

}
