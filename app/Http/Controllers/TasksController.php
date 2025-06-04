<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Create a test task data
        $tasks = collect([
            (object)[
            'name' => 'Test Task 1',
            'description' => 'This is a test task description 1.',
            'status' => 'Waiting',
            'priority' => 'High',
            'type' => 'feature',
            'deadline' => now()->addDays(7)->toDateTimeString(),
            'created_at' => now(),
            'assigned_to' => 'John Doe',
            'files' => [
            (object)[
            'name' => 'specification1.pdf',
            'path' => 'tasks/specification1.pdf'
            ]
            ]
            ],
            (object)[
            'name' => 'Test Task 2',
            'description' => 'This is a test task description 2.',
            'status' => 'In Progress',
            'priority' => 'Medium',
            'type' => 'bug',
            'deadline' => now()->addDays(3)->toDateTimeString(),
            'created_at' => now()->subDay(),
            'assigned_to' => 'Jane Smith',
            'files' => []
            ],
            (object)[
            'name' => 'Test Task 3',
            'description' => 'This is a test task description 3.',
            'status' => 'Complete',
            'priority' => 'Low',
            'type' => null,
            'deadline' => null,
            'created_at' => now()->subDays(2),
            'assigned_to' => 'Alice Johnson',
            'files' => [
            (object)[
            'name' => 'report.docx',
            'path' => 'tasks/report.docx'
            ]
            ]
            ],
            (object)[
            'name' => 'Test Task 4',
            'description' => 'This is a test task description 4.',
            'status' => 'Waiting',
            'priority' => 'High',
            'type' => 'improvement',
            'deadline' => now()->addDays(10)->toDateTimeString(),
            'created_at' => now()->subDays(3),
            'assigned_to' => 'Bob Brown',
            'files' => []
            ],
            (object)[
            'name' => 'Test Task 5',
            'description' => 'This is a test task description 5.',
            'status' => 'In Progress',
            'priority' => 'Medium',
            'type' => 'feature',
            'deadline' => now()->addDays(5)->toDateTimeString(),
            'created_at' => now()->subDays(4),
            'assigned_to' => 'Charlie Green',
            'files' => [
            (object)[
            'name' => 'design.png',
            'path' => 'tasks/design.png'
            ]
            ]
            ],
            (object)[
            'name' => 'Test Task 6',
            'description' => 'This is a test task description 6.',
            'status' => 'Complete',
            'priority' => 'Low',
            'type' => null,
            'deadline' => null,
            'created_at' => now()->subDays(5),
            'assigned_to' => 'Diana Prince',
            'files' => []
            ],
            (object)[
            'name' => 'Test Task 7',
            'description' => 'This is a test task description 7.',
            'status' => 'Waiting',
            'priority' => 'High',
            'type' => 'bug',
            'deadline' => now()->addDays(2)->toDateTimeString(),
            'created_at' => now()->subDays(6),
            'assigned_to' => 'Eve Adams',
            'files' => [
            (object)[
            'name' => 'log.txt',
            'path' => 'tasks/log.txt'
            ],
            (object)[
            'name' => 'log.png',
            'path' => 'tasks/log.png'
            ]
            ]
            ],
            (object)[
            'name' => 'Test Task 8',
            'description' => 'This is a test task description 8.',
            'status' => 'In Progress',
            'priority' => 'Medium',
            'type' => 'improvement',
            'deadline' => now()->addDays(1)->toDateTimeString(),
            'created_at' => now()->subDays(7),
            'assigned_to' => 'Frank Miller',
            'files' => []
            ],
        ]);
        return view('pages.Tasks', ['tasks' => $tasks]);
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
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //return
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'deadline' => 'required|date',
        // ]);

        // $tasks->update([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'deadline' => $request->deadline,
        // ]);

        // return redirect()->route('tasks.index')->with('success', 'Tasks updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
