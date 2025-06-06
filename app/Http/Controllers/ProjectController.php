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
        // $projects = collect([
        //     (object)[
        //         'id' => 1,
        //         'task_id' => 1,
        //         'name' => 'Project Alpha',
        //         'owner' => 'Alice',
        //         'image' => 'alpha.jpg',
        //         'description' => 'First project description',
        //         'status' => 'On hold',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-12-31 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 2,
        //         'task_id' => 2,
        //         'name' => 'Project Beta',
        //         'owner' => 'Bob',
        //         'image' => 'beta.jpg',
        //         'description' => 'Second project description',
        //         'status' => 'In progress',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-11-30 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 3,
        //         'task_id' => 3,
        //         'name' => 'Project Beta',
        //         'owner' => 'Bob',
        //         'image' => 'beta.jpg',
        //         'description' => 'Second project description',
        //         'status' => 'Complete',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-11-30 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 1,
        //         'task_id' => 1,
        //         'name' => 'Project Alpha',
        //         'owner' => 'Alice',
        //         'image' => 'alpha.jpg',
        //         'description' => 'First project description',
        //         'status' => 'On hold',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-12-31 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 2,
        //         'task_id' => 2,
        //         'name' => 'Project Beta',
        //         'owner' => 'Bob',
        //         'image' => 'beta.jpg',
        //         'description' => 'Second project description',
        //         'status' => 'In progress',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-11-30 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 3,
        //         'task_id' => 3,
        //         'name' => 'Project Beta',
        //         'owner' => 'Bob',
        //         'image' => 'beta.jpg',
        //         'description' => 'Second project description',
        //         'status' => 'Complete',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-11-30 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 1,
        //         'task_id' => 1,
        //         'name' => 'Project Alpha',
        //         'owner' => 'Alice',
        //         'image' => 'alpha.jpg',
        //         'description' => 'First project description',
        //         'status' => 'On hold',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-12-31 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 2,
        //         'task_id' => 2,
        //         'name' => 'Project Beta',
        //         'owner' => 'Bob',
        //         'image' => 'beta.jpg',
        //         'description' => 'Second project description',
        //         'status' => 'In progress',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-11-30 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     (object)[
        //         'id' => 3,
        //         'task_id' => 3,
        //         'name' => 'Project Beta',
        //         'owner' => 'Bob',
        //         'image' => 'beta.jpg',
        //         'description' => 'Second project description',
        //         'status' => 'Complete',
        //         'is_deleted' => 'false',
        //         'deadline' => '2024-11-30 23:59:59',
        //         'start_date' => '2024-01-01 00:00:00',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        $projects = Project::where('is_deleted', 'false')->get();
        // $projects = Project::all();
        // $projects = Project::where('is_deleted', 'false')->get();
        // $projects = Project::where('is_deleted', 'false')->orderBy('created_at', 'desc')->get();

        // Pass the data to the view
        return view('pages.Project ', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Form.Projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'description' => 'required|string',
            'status' => 'required|string|in:On hold,In progress,Complete',
            'deadline' => 'required|date',
            'start_date' => 'required|date',
        ]);

        // if ($request->fails()) {
        //     return response()->json(['errors' => $request->errors()], 422);
        // }

        // return $validatedData;
        // dd($validatedData);
        // return $validatedData['start_date'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $filename);
        } else {
            $filename = 'default_images.png';
        }

        Project::create([
            'name' => $validatedData['name'],
            'owner' => $validatedData['owner'],
            'image' => $filename,
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'deadline' => $validatedData['deadline'],
            'start_date' => $validatedData['start_date'],
        ]);
        return redirect()->route('project.create')->with('success', 'Project created successfully.');
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
