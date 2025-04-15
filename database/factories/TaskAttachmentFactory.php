<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskAttachment>
 */
class TaskAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => $this->faker->numberBetween(1, 30),
            'file_name' => $this->faker->word(),
            'file_path' => $this->faker->word(),
            'file_size' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
