<?php

namespace App\Services\Colors\Interfaces;
use App\DTOs\Colors\ColorParamsDto;
use App\Models\Color;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Service Interface for color to deal with Read operations
 */
interface GetColorsService
{
    /** Get all colors */
    public function getAllColors(): Collection;
    
    /**
     * Get colors
     */
    public function getColorsByParams(ColorParamsDto $params): LengthAwarePaginator;

    /**
     * Get one color by ID
     * @return \App\Models\Color
     * @throws \App\Exceptions\Colors\ColorNotFoundException
     */
    public function getColorById(string $id): Color;
}
