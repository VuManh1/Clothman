<?php

namespace App\Services\Colors\Interfaces;

use App\DTOs\Colors\CreateColorDto;

/**
 * Service Interface for colors to deal with CUD (Create, Update, Delete) operations
 */
interface ManageColorsService
{
    /**
     * Create a color
     */
    public function createColor(CreateColorDto $createColorDto);

    // public function updateColor(UpdateColorDto $updateColorDto);
    // public function deleteColor(DeleteColorDto $deleteColorDto);
}
