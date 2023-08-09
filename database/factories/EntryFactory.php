<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry>
 */
class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $task_ids = DB::table('tasks')->pluck('id');
        $user_ids = DB::table('users')->pluck('id');
        return [
            // 'name' => fake()->sentence(),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['in_progress', 'completed']),
            'time' => fake()->numberBetween(1, 4),
            'user_id' => fake()->randomElement($user_ids),
            'task_id' => fake()->randomElement($task_ids),
            'created_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
