<?php

namespace Tests\Unit\Repositories;

use App\Models\Color;
use App\Repositories\Implementations\EloquentColorRepository;
use App\Repositories\Interfaces\ColorRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ColorRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ColorRepository $colorRepository;

    public function setUp(): void {
        parent::setUp();
        $this->colorRepository = new EloquentColorRepository;
    }

    public function test_it_can_find_one_color()
    {
        $color = Color::factory()->create();
        $foundColor = $this->colorRepository->findById($color->id);

        $this->assertEquals($foundColor->id, $color->id);
    }

    public function test_it_can_create_color()
    {
        $data = [
            'name' => 'Xanh',
            'hex_code' => '#121212'
        ];

        $color = $this->colorRepository->create($data);

        $this->assertTrue($color instanceof Color);
        $this->assertEquals($color->name, $data['name']);
        $this->assertEquals($color->hex_code, $data['hex_code']);
    }

    public function test_it_can_update_color()
    {
        $color = Color::factory()->create();
        $newData = [
            'name' => 'New color name',
            'hex_code' => '#000000'
        ];

        $updatedColor = $this->colorRepository->update($color->id, $newData);

        $this->assertEquals($updatedColor->name, $newData['name']);
        $this->assertEquals($updatedColor->hex_code, $newData['hex_code']);
    }

    public function test_it_can_soft_delete_color()
    {
        $color = Color::factory()->create();
        $this->colorRepository->delete($color->id);

        $this->assertSoftDeleted('colors', [
            'id' => $color->id,
        ]);
    }
}
