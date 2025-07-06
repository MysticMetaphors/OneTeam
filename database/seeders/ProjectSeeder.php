<?php

// use Illuminate\Database\Seeder;
// use App\Models\Project;
// use App\Models\Tasks;
// use App\Models\Team_members;

// class ProjectSeeder extends Seeder
// {
//     public function run()
//     {
//         Project::create([
//             'name' => 'Website Redesign',
//             'owner' => 'Admin User',
//             'image' => 'default_project.png',
//             'description' => 'Redesign of corporate website.',
//             'status' => 'New',
//             'deadline' => now()->addDays(30),
//             'start_date' => now(),
//         ]);

//         Tasks::create([
//             'project_id' => 1,
//             'issued_to' => 2,
//             'title' => 'Create Homepage',
//             'description' => 'Build the homepage UI',
//             'priority' => 'High',
//             'status' => 'Scheduled',
//             'deadline' => now()->addDays(7),
//         ]);

//         Tasks::create([
//             'project_id' => 1,
//             'issued_to' => 2,
//             'title' => 'Setup Database',
//             'description' => 'Design and migrate DB schema',
//             'priority' => 'Medium',
//             'status' => 'Waiting',
//             'deadline' => now()->addDays(10),
//         ]);

//         Team_members::create([
//             'project_id' => 1,
//             'user_id' => 1,
//         ]);

//         Team_members::create([
//             'project_id' => 1,
//             'user_id' => 2,
//         ]);
//     }
// }
