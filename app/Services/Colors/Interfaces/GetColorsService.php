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

    /**
     * Get one color by ID
     * @return \App\Models\Color
     * @throws \App\Exceptions\Colors\ColorNotFoundException
     */
    public function getColorById(string $id): Color;
}
