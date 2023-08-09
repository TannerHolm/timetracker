<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectIds = DB::table('projects')->pluck('id');
        $userIds = DB::table('users')->pluck('id');

        for ($i = 0; $i < 4; $i++) {
            DB::table('project_user')->insert([
                'project_id' => $projectIds->random(),
                'user_id' => $userIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
