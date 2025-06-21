<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Project;
use App\Models\User;
use App\Models\Activity;
use App\Models\Subtasks;
use App\Models\TaskAttachment;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $tasks = Tasks::all();
            $users = User::all();
        } else {
            $id = Auth::user()->id;
            $tasks = Tasks::where('issued_to', $id)->get();
            $users = null;
        }

        // dd($tasks);
        // return $tasks;
        // return view('pages.Tasks', [
        //     'tasks' => $tasks,
        //     'users' => $users
        // ]);

        return Inertia::render('Task', [
            'tasks' => $tasks,
            'users' => $users,
            'currentUser' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();

        return Inertia::render('Form/TaskCreate', [
            'projects' => $projects,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validateData = $request->validate([
            'title' => 'required|string|max:30|min:3',
            'description' => 'required|string|max:255',
            'priority' => 'required|in:High,Medium,Low',
            'assignee' => 'required|string',
            'project' => 'required|string',
            'deadline' => 'required|date',
            'type' => 'required|string|max:20',
            'sub' => 'nullable|array',
            'attach' => 'nullable|file|mimes:pdf,png,docx',
            'repeat_interval' => 'nullable|string'
        ]);

        $validateData['assignee'] = (int) $validateData['assignee'];
        $validateData['project'] = (int) $validateData['project'];
        $validateData['repeat_interval'] = (int) $validateData['repeat_interval'];

        if ($validateData['repeat_interval']) {
            $is_repeat = 'true';
            $status = 'Scheduled';
        } else {
            $is_repeat = 'false';
            $status = 'Waiting';
        }

        $task = Tasks::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'priority' => $validateData['priority'],
            'issued_to' => $validateData['assignee'],
            'project_id' => $validateData['project'],
            'deadline' => $validateData['deadline'],
            'type' => $validateData['type'],
            'repeat_interval' => $validateData['repeat_interval'],
            'is_repeat' => $is_repeat,
            'status' => $status
        ]);

        if (!empty($validateData['sub'])) {
            foreach ($validateData['sub'] as $subtaskText) {
                Subtasks::create([
                    'task_id' => $task->id,
                    'title' => $subtaskText,
                ]);
            }
        }

        if (!empty($validateData['attach'])) {
            $file = $request->file('attach');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename);

            TaskAttachment::create([
                'task_id' => $task->id,
                'file_name' => $filename,
            ]);
        }

        Activity::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'made_by' => Auth::user()->id,
            'action' => 'Create',
            'type' => 'Task',
        ]);

        return response()->json(['message' => 'Task created successfully.']);
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
