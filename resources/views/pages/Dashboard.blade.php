@extends('pages.layouts.Main')

@section('title', 'Dashboard')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container page-header">
            <h1 class="page-title">Dashboard</h1>
            <button class="theme-toggle">
                <span class="material-symbols-rounded" id="moonIcon">&#xe518;</span>
                <span class="material-symbols-rounded" id="sunIcon" style="display: none;">&#xe51c;</span>
            </button>
        </div>
        <div class="d-flex-row-container">
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center">
                    <span class="me-3">
                        <i class="bi bi-bar-chart-fill" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="card-title mb-1">Statistics</h5>
                        <p class="card-text mb-0">Some quick example text.</p>
                    </div>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center">
                    <span class="me-3">
                        <i class="bi bi-bar-chart-fill" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="card-title mb-1">Statistics</h5>
                        <p class="card-text mb-0">Some quick example text.</p>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center">
                    <span class="me-3">
                        <i class="bi bi-bar-chart-fill" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="card-title mb-1">Statistics</h5>
                        <p class="card-text mb-0">Some quick example text.</p>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center">
                    <span class="me-3">
                        <i class="bi bi-bar-chart-fill" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="card-title mb-1">Statistics</h5>
                        <p class="card-text mb-0">Some quick example text.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
