<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Models\Activity;
use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = [
            'Scheduled' => ['original' => 'Scheduled', 'tag' => 'tag-primary'],
            'Waiting' => ['original' => 'Waiting', 'tag' => 'tag-grey'],
            'Processing' => ['original' => 'Processing', 'tag' => 'tag-warning'],
            'Completed' => ['original' => 'Completed', 'tag' => 'tag-success'],
        ];

        $project = Project::limit(5)->get();
        $task = Tasks::where('issued_to', Auth::user()->id)->get();
        $activity = Activity::limit(5)->get();

        return Inertia::render('Dashboard', [
            'statuses' => $statuses,
            'project' => $project,
            'task' => $task,
            // 'activity' => $activity
        ]);
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
    public function show(Dashboard $Dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $Dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $Dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $Dashboard)
    {
        //
    }
}
