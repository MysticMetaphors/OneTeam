<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data placeholder based on the table structure
        $projects = collect([
            (object)[
                'id' => 1,
                'task_id' => 1,
                'name' => 'Project Alpha',
                'owner' => 'Alice',
                'image' => 'alpha.jpg',
                'description' => 'First project description',
                'status' => 'On hold',
                'is_deleted' => 'false',
                'deadline' => '2024-12-31 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 2,
                'task_id' => 2,
                'name' => 'Project Beta',
                'owner' => 'Bob',
                'image' => 'beta.jpg',
                'description' => 'Second project description',
                'status' => 'In progress',
                'is_deleted' => 'false',
                'deadline' => '2024-11-30 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 3,
                'task_id' => 3,
                'name' => 'Project Beta',
                'owner' => 'Bob',
                'image' => 'beta.jpg',
                'description' => 'Second project description',
                'status' => 'Complete',
                'is_deleted' => 'false',
                'deadline' => '2024-11-30 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 1,
                'task_id' => 1,
                'name' => 'Project Alpha',
                'owner' => 'Alice',
                'image' => 'alpha.jpg',
                'description' => 'First project description',
                'status' => 'On hold',
                'is_deleted' => 'false',
                'deadline' => '2024-12-31 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 2,
                'task_id' => 2,
                'name' => 'Project Beta',
                'owner' => 'Bob',
                'image' => 'beta.jpg',
                'description' => 'Second project description',
                'status' => 'In progress',
                'is_deleted' => 'false',
                'deadline' => '2024-11-30 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 3,
                'task_id' => 3,
                'name' => 'Project Beta',
                'owner' => 'Bob',
                'image' => 'beta.jpg',
                'description' => 'Second project description',
                'status' => 'Complete',
                'is_deleted' => 'false',
                'deadline' => '2024-11-30 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 1,
                'task_id' => 1,
                'name' => 'Project Alpha',
                'owner' => 'Alice',
                'image' => 'alpha.jpg',
                'description' => 'First project description',
                'status' => 'On hold',
                'is_deleted' => 'false',
                'deadline' => '2024-12-31 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 2,
                'task_id' => 2,
                'name' => 'Project Beta',
                'owner' => 'Bob',
                'image' => 'beta.jpg',
                'description' => 'Second project description',
                'status' => 'In progress',
                'is_deleted' => 'false',
                'deadline' => '2024-11-30 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object)[
                'id' => 3,
                'task_id' => 3,
                'name' => 'Project Beta',
                'owner' => 'Bob',
                'image' => 'beta.jpg',
                'description' => 'Second project description',
                'status' => 'Complete',
                'is_deleted' => 'false',
                'deadline' => '2024-11-30 23:59:59',
                'start_date' => '2024-01-01 00:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Pass the data to the view
        return view('pages.Project ', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
