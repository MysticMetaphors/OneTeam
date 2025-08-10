<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Tasks;
use App\Models\Team_members;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('test101'),
            'role' => 'Admin',
            'position' => 'Project Manager',
            'birthdate' => '1990-01-01',
            'location' => 'Office',
            'contact' => '09171234567',
        ]);

        User::create([
            'name' => 'Member1',
            'email' => 'member@gmail.com',
            'password' => Hash::make('test101'),
            'role' => 'Member',
            'position' => 'Developer',
            'birthdate' => '1995-05-15',
            'location' => 'Remote',
            'contact' => '09179876543',
        ]);

        User::create([
            'name' => 'Demo User Admin',
            'email' => 'DemoAdmin@gmail.com',
            'password' => Hash::make('demo123'),
            'role' => 'Admin',
            'position' => 'Project Manager',
            'birthdate' => '1990-01-01',
            'location' => 'Office',
            'contact' => '09171234567',
        ]);

        User::create([
            'name' => 'Demo User Member',
            'email' => 'DemoMember@gmail.com',
            'password' => Hash::make('demo123'),
            'role' => 'Member',
            'position' => 'Developer',
            'birthdate' => '1995-05-15',
            'location' => 'Remote',
            'contact' => '09179876543',
        ]);

        $this->call([
            UserSeeder::class,
            ProjectSeeder::class
        ]);

        // Project::create([
        //     'name' => 'Website Redesign',
        //     'owner' => 'Admin User',
        //     'image' => 'default_project.png',
        //     'description' => 'Redesign of corporate website.',
        //     'status' => 'New',
        //     'deadline' => now()->addDays(30),
        //     'start_date' => now(),
        // ]);

        // Tasks::create([
        //     'project_id' => 1,
        //     'issued_to' => 2,
        //     'title' => 'Create Homepage',
        //     'description' => 'Build the homepage UI',
        //     'priority' => 'High',
        //     'status' => 'Scheduled',
        //     'deadline' => now()->addDays(7),
        // ]);

        // Tasks::create([
        //     'project_id' => 1,
        //     'issued_to' => 2,
        //     'title' => 'Setup Database',
        //     'description' => 'Design and migrate DB schema',
        //     'priority' => 'Medium',
        //     'status' => 'Waiting',
        //     'deadline' => now()->addDays(10),
        // ]);

        // Team_members::create([
        //     'project_id' => 1,
        //     'user_id' => 1,
        // ]);

        // Team_members::create([
        //     'project_id' => 1,
        //     'user_id' => 2,
        // ]);
    }
}
