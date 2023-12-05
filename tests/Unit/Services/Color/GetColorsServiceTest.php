<?php

namespace Tests\Unit\Services\Color;

use App\DTOs\Colors\ColorParamsDto;
use App\Exceptions\Colors\ColorNotFoundException;
use App\Models\Color;
use App\Services\Colors\Implementations\GetColorsServiceImpl;
use App\Services\Colors\Interfaces\GetColorsService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GetColorsServiceTest extends TestCase
{
    private GetColorsService $getColorsService;

    public function setUp(): void
    {
        parent::setUp();

        $this->getColorsService = App::make(GetColorsServiceImpl::class);
    }

    public function test_it_can_get_one_color_by_ID()
    {
        $color = Color::factory()->create();
        $foundColor = $this->getColorsService->getColorById($color->id);

        $this->assertEquals($foundColor->id, $color->id);
    }

    public function test_it_throw_exception_if_ID_not_exists()
    {
        $this->assertThrows(
            fn () => $this->getColorsService->getColorById('abc'),
            ColorNotFoundException::class
        );
    }

    public function test_it_return_paginated_colors()
    {
        Color::factory()->count(3)->create();

        $limit = 2;
        $params = new ColorParamsDto(0, $limit, null, null, null);

        $colors = $this->getColorsService->getColorsByParams($params);

        $this->assertTrue($colors->count() === $limit);
    }
}
