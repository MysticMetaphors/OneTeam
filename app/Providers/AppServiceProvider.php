<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
                $projects = Project::all();
                foreach ($projects as $project) {
                    $project->encrypt = Crypt::encryptString($project->id);
                }
                return [
                    'user' => Auth::user(),
                    'projects' => $projects
                ];
            },
        ]);
    }
}
