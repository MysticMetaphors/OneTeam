@extends('pages.layouts.Main')

@section('title', 'Dashboard')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div></div>
            <div class="d-flex-row-container">
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                    onclick="window.location.href='{{ route('project.create') }}'">
                    <span class="material-symbols-rounded">add</span>
                    New project
                </button>
                <button class="btn notification-btn btn-no-bg" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn mail-btn btn-no-bg" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg">
                    <span class="material-symbols-rounded" id="sunIcon" style="display: none;">&#xe51c;</span>
                    <span class="material-symbols-rounded" id="moonIcon">&#xe518;</span>
                </button>
            </div>
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
        <div class="d-flex-row-container">
            <div class="card" style="width: 100%; margin-bottom: 1rem;">
                <div class="card-body d-flex align-items-center">
                    <span class="me-3">
                        <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                    </span>
                    <div>
                        <h5 class="card-title mb-1">Team Members</h5>
                        <p class="card-text mb-0">Manage your team and assign roles.</p>
                    </div>
                </div>
            </div>
            <table class="table table-striped tasks-table">
                <thead>
                    <tr>
                        <th colspan="5">
                            <h2>Open Projects</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Website Redesign</td>
                        <td>Alice Smith</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>2024-07-15</td>
                        <td>
                            <button class="btn btn-sm btn-primary" title="View"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-secondary" title="Edit"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Mobile App Launch</td>
                        <td>Bob Johnson</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>2024-08-01</td>
                        <td>
                            <button class="btn btn-sm btn-primary" title="View"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-secondary" title="Edit"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>API Integration</td>
                        <td>Carol Lee</td>
                        <td><span class="badge bg-info text-dark">In Progress</span></td>
                        <td>2024-07-30</td>
                        <td>
                            <button class="btn btn-sm btn-primary" title="View"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-secondary" title="Edit"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
