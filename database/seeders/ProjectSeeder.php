<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Subtasks;
use App\Models\Tasks;
use App\Models\Team_members;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{

    public function run(int $count = 20): void
    {
        $users = User::all();

        if ($users->count() < 1) {
            $this->command->warn('No users found. Please seed users first.');
            return;
        }

        for ($i = 1; $i <= $count; $i++) {
            $owner = $users->random();

            $project = Project::create([
                'name' => "Project #$i",
                'owner' => $owner->name,
                'image' => 'default_project.png',
                'description' => Str::random(255),
                'status' => 'New',
                'deadline' => now()->addDays(rand(30, 90)),
                'start_date' => now(),
            ]);

            Team_members::create([
                'project_id' => $project->id,
                'user_id' => $owner->id,
            ]);

            $members = $users->where('id', '!=', $owner->id)->random(min(3, $users->count() -1));
            foreach ($members as $member) {
                Team_members::create([
                    'project_id' => $project->id,
                    'user_id' => $member->id,
                ]);
            }

            $taskCount = rand(1, 5);
            for ($j = 1; $j <= $taskCount; $j++) {
                $assigned = $members->random();

                $task = Tasks::create([
                    'project_id' => $project->id,
                    'issued_to' => $assigned->id,
                    'title' => "Task #$j for Project #$i",
                    'description' => Str::random(255),
                    'priority' => fake()->randomElement(['High', 'Medium', 'Low']),
                    'status' => fake()->randomElement(['Scheduled', 'Processing', 'Waiting', 'Completed', 'Cancelled']),
                    'deadline' => now()->addDays(rand(7, 30)),
                ]);

                $subtaskCount = rand(0, 5);
                for ($k = 1; $k <= $subtaskCount; $k++) {
                    Subtasks::create([
                        'task_id' => $task->id,
                        'title' => "Subtask #$k of Task #$j (Project #$i)",
                        'is_completed' => 'false',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->command->info("$count projects with tasks and subtasks created successfully.");
    }
}
