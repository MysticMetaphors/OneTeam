<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Team_members;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Inertia::share([
            'auth' => function () {
                if (!Auth::check()) {
                    return null;
                }
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
                return [
                    'user' => Auth::user(),
                    'projects' => $project
                ];
            },
        ]);
    }
}
