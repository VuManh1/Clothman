<?php

namespace Tests\Unit\Services\Color;

use App\DTOs\Colors\CreateColorDto;
use App\DTOs\Colors\UpdateColorDto;
use App\Exceptions\UniqueFieldException;
use App\Models\Color;
use App\Services\Colors\Implementations\ManageColorsServiceImpl;
use App\Services\Colors\Interfaces\ManageColorsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ManageColorsServiceTest extends TestCase
{
    use RefreshDatabase;

    private ManageColorsService $manageColorsService;

    public function setUp(): void
    {
        parent::setUp();

        $this->manageColorsService = App::make(ManageColorsServiceImpl::class);
    }

    public function test_it_can_create_color()
    {
        $dto = new CreateColorDto('Xanh', '#121212');

        $color = $this->manageColorsService->createColor($dto);

        $this->assertInstanceOf(Color::class, $color);
    }

    public function test_it_throw_error_when_create_duplicated_color()
    {
        $dto = new CreateColorDto('Xanh', '#121212');

        $this->manageColorsService->createColor($dto);

        $this->assertThrows(
            fn () => $this->manageColorsService->createColor($dto),
            UniqueFieldException::class
        );
    }

    public function test_it_can_update_color()
    {
        $color = Color::factory()->create();
        $dto = new UpdateColorDto('New Xanh', '#121212');

        $updatedColor = $this->manageColorsService->updateColor($color->id, $dto);

        $this->assertInstanceOf(Color::class, $updatedColor);
        $this->assertEquals($updatedColor->name, $dto->name);
        $this->assertEquals($updatedColor->hex_code, $dto->hex_code);
    }

    public function test_it_can_delete_color()
    {
        $color = Color::factory()->create();

        $result = $this->manageColorsService->deleteColor($color->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted('colors', ['id' => $color->id]);
    }
}
