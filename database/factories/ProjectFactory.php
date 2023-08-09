<?php

namespace Database\Factories;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $client_ids = DB::table('clients')->pluck('id');
        $project_titles = [
            'Pet Neutra Website Build',
            'Website Build',
            'Website Redesign',    
        ];

        return [
            'name' => fake()->randomElement($project_titles),
            'description' => fake()->sentence(),
            'start_date' => fake()->date(),
            'status' => fake()->randomElement(['in_progress', 'completed']),
            'budget' => fake()->numberBetween(1, 100),
            'notes' => fake()->sentence(),
            'client_id' => fake()->randomElement($client_ids),
        ];
    }
}
