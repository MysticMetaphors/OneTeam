<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Models\Team_members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $role = Auth::user()->role;

        if ($role == 'Admin') {
            $project = Project::where('is_deleted', 'false')->get();
            foreach ($project as $proj) {
                $proj->encrypt = Crypt::encryptString($proj->id);
            }
        } else {
            $project = [];
            $project_ids = [];
            $team_members = Team_members::where('user_id', $id)->get();

            foreach ($team_members as $team) {
                array_push($project_ids, $team->project_id);
            }

            foreach ($project_ids as $ids) {
                $proj = Project::where('id', $ids)->where('is_deleted', 'false')->first();
                $proj->encrypt = Crypt::encryptString($proj->id);
                array_push($project, $proj);
            }

            foreach ($project as $proj) {
                $proj->encrypt = Crypt::encryptString($proj->id);
            }
        }
        return Inertia::render('Project', [
            'projects' => $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Form/ProjectCreate');
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
            'status' => 'required|string|in:New,On hold,In progress,Complete',
            'deadline' => 'required|date',
            'start_date' => 'required|date',
        ]);

        // if ($request->fails()) {
        //     return response()->json(['errors' => $request->errors()], 422);
        // }

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

        Activity::create([
            'title' => $validatedData['name'],
            'description' => $validatedData['description'],
            'made_by' => Auth::user()->id,
            'action' => 'Create',
            'type' => 'Project',
        ]);
        return response()->json(['message' => 'Project created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, $id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $tasks = Tasks::where('id', $decryptedId)->get();

            $users = User::all();
            // return view('pages.ViewProject', [
            //     'tasks' => $tasks,
            //     'users' => $users
            // ]);
            return Inertia::render('Form.ProjectCreate', [
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
