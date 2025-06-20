<?php

namespace App\Providers;

use App\Models\Project;use Illuminate\Support\Facades\Auth;
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
        // Load data only when the 'layouts.app' layout is used
        View::composer('pages.layouts.Main', function ($view) {
            $projects = Project::all();
            foreach ($projects as $project) {
                $project->encrypt = Crypt::encryptString($project->id);
            }
            $view->with('projects', $projects);
        });

        Inertia::share([
            'auth' => function () {
                return [
                    'user' => Auth::user(),
                ];
            },
        ]);
    }
}
