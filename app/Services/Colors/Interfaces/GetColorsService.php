<?php

namespace App\Services\Colors\Interfaces;

/**
 * Service Interface for color to deal with Read operations
 */
interface GetColorsService
{
    /**
     * Get colors
     * @return mixed
     */
    public function get();
}
