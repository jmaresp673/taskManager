<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected static int $positionCounter = 0;

    /**
     * Define the model's factory to seed the database.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'color_code' => $this->faker->hexColor(),
            'description' => $this->faker->sentence(),
            'parent_id' => null,
            'position' => self::$positionCounter++,
        ];
    }
}
