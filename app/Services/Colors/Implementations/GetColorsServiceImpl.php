<?php

namespace App\Services\Colors\Implementations;

use App\Repositories\Interfaces\ColorRepository;
use App\Services\Colors\Interfaces\GetColorsService;

/**
 * Summary of GetColorsServiceImpl
 */
class GetColorsServiceImpl implements GetColorsService
{
    /**
     * Summary of __construct
     * @param \App\Repositories\Interfaces\ColorRepository $colorRepository
     */
    public function __construct(
        private ColorRepository $colorRepository
    ) {}

    /**
     * Summary of get
     * @return mixed
     */
    public function get() {
        return $this->colorRepository->getAll();
    }
}
