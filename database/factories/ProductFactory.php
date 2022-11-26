<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type_gender = $this->faker->randomElement(['W', 'w', 'M', 'm', 'B', 'b']); // male Women's baby
        $name = $this->faker->realText(rand(10, 30));

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => rand(100, 2000),
            'content' => $this->faker->realText(rand(150, 200)),
            'type_gender' => $type_gender,
        ];
    }
}
