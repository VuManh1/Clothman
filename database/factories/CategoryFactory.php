<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Category::class;

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = Str::random(6);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'banner_url' => Str::random(6)
        ];
    }
}
