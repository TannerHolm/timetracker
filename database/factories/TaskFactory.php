<?php

namespace Database\Factories;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project_ids = DB::table('projects')->pluck('id');
        $task_names = [
            'Admin',
            'Business Development',
            'Web Development'
        ];

        return [
            'name' => fake()->randomElement($task_names),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['in_progress', 'completed']),
            'billable' => fake()->randomElement([true, false]),
            'project_id' => fake()->randomElement($project_ids),
        ];
    }
}
