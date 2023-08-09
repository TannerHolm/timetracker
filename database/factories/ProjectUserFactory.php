<?php
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectUserFactory extends Factory
{
    protected $model = ProjectUser::class;

    public function definition()
    {
        return [
            // No need to define attributes here for pivot table
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ProjectUser $pivot) {
            // Define the logic to seed the pivot table here
            $project = Project::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();
            
            // Attach the user to the project in the pivot table
            $project->users()->attach($user);
        });
    }
}
