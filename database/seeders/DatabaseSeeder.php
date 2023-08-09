<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Tanner Holm',
            'email' => 'holm.tanner@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        // \App\Models\Client::factory(2)->create();
        \App\Models\Client::factory()->create([
            'name' => 'Pet Neutra',
            'email' => 'info@petneutra.com',
            'phone' => '801-555-5555',
            'address' => '1234 Main St. Salt Lake City, UT 84101',
            'notes' => 'This is a note about Pet Neutra',
        ]);
        \App\Models\Project::factory(2)->create();


        \App\Models\Task::factory(2)->create();

        \App\Models\Entry::factory(20)->create();
        \App\Models\Entry::factory()->create([
            'description' => 'This is a description of the Create a new Laravel Project Entry',
            'status' => 'In Progress',
            'time' => 1,
            'task_id' => 1,
            'user_id' => 1,
            'created_at' => now()->startOfDay()->addHours(9),

        ]);
        \App\Models\Entry::factory()->create([
            'description' => 'This is a description of the Create a new Laravel Project Entry',
            'status' => 'In Progress',
            'time' => 1,
            'task_id' => 1,
            'user_id' => 1,
            'created_at' => now()->startOfDay()->addHours(9),
        ]);
    }
}
