<?php

namespace Tests\Unit\Repositories;

use App\Models\Color;
use App\Repositories\Implementations\EloquentColorRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ColorRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test get all colors
     *
     * @return void
     */
    public function test_return_all_colors()
    {
        $colorRepository = new EloquentColorRepository;

        $data = $colorRepository->getAll();
        $this->assertTrue(is_a($data, 'Illuminate\Support\Collection'));
    }

    /**
     *
     * @return void
     */
    public function test_return_null_when_record_is_not_exists()
    {
        $colorRepository = new EloquentColorRepository;

        $data = $colorRepository->findById("abc");
        $this->assertTrue($data === null);
    }

    /**
     * test insert one color to database
     *
     * @return void
     */
    public function test_create_color()
    {
        $colorRepository = new EloquentColorRepository;
        $data = [
            'name' => 'Đen',
            'hex_code' => '#121212'
        ];

        $result = $colorRepository->create($data);

        $this->assertTrue($result instanceof Color);
    }
}
