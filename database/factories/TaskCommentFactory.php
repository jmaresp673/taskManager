<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskComment>
 */
class TaskCommentFactory extends Factory
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
            'user_id' => $this->faker->numberBetween(1, 10),
            'comment' => $this->faker->sentence,
        ];
    }
}
