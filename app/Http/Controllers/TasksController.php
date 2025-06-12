<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::all();
        $users = User::all();
        return view('pages.Tasks', [
            'tasks' => $tasks,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        $projects = Project::all();
        return view('Form.Task.create', [
            'projects' => $projects,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'title' => 'required|string|max:30|min:3',
            'description' => 'required|string|max:255',
            'priority' => 'required|in:High,Medium,Low',
            'assignee' => 'required|integer',
            'project' => 'required|integer',
            'deadline' => 'required|date',
            'type' => 'required|string|max:20',
        ]);

        Tasks::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'priority' => $validateData['priority'],
            'issued_to' => $validateData['assignee'],
            'project_id' => $validateData['project'],
            'deadline' => $validateData['deadline'],
            'type' => $validateData['type'],
        ]);

        Activity::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'made_by' => Auth::user()->id,
            'action' => 'Create',
            'type' => 'Task',
        ]);

        return redirect()->route('task.create')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks, $id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $tasks = Tasks::where('project_id', $decryptedId)->get();

            $users = User::all();
            return view('pages.Tasks', [
                'tasks' => $tasks,
                'users' => $users
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
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
