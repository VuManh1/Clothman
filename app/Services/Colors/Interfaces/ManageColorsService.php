<?php

namespace App\Services\Colors\Interfaces;

use App\DTOs\Colors\CreateColorDto;
use App\DTOs\Colors\UpdateColorDto;
use App\Models\Color;

/**
 * Service Interface for colors to deal with CUD (Create, Update, Delete) operations
 */
interface ManageColorsService
{
    /**
     * Create a color
     * 
     * @throws \App\Exceptions\Colors\ColorDuplicatedException
     */
    public function createColor(CreateColorDto $createColorDto): Color;

    /**
     * edit a color
     * 
     * @throws \App\Exceptions\Colors\ColorDuplicatedException
     */
    public function updateColor($id, UpdateColorDto $updateColorDto): Color;

    /**
     * Delete a color
     */
    public function deleteColor($id): bool;
}
