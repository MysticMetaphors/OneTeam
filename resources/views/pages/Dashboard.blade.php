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
        {{-- <div class="d-flex-row-container">
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
        </div> --}}
        {{-- <div class="d-flex-row-container">
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

                    </tr>
                    <tr>
                        <td>Mobile App Launch</td>
                        <td>Bob Johnson</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>2024-08-01</td>

                    </tr>
                    <tr>
                        <td>API Integration</td>
                        <td>Carol Lee</td>
                        <td><span class="badge bg-info text-dark">In Progress</span></td>
                        <td>2024-07-30</td>

                    </tr>
                </tbody>
            </table>
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
                    </tr>
                    <tr>
                        <td>Mobile App Launch</td>
                        <td>Bob Johnson</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>2024-08-01</td>
                    </tr>
                    <tr>
                        <td>API Integration</td>
                        <td>Carol Lee</td>
                        <td><span class="badge bg-info text-dark">In Progress</span></td>
                        <td>2024-07-30</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        {{-- <table class="table table-striped tasks-table">
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
        </div> --}}

        <div class="d-flex-row-container">
            <div class="card">
                Completed Tasks
            </div>
            <div class="card">
                Total Assigned
            </div>
            <div class="card">
                Late Submission
            </div>
            <div class="card">
                On time
            </div>
        </div>

        <div class="table-container" id="task-table-view">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">

                                <div class="d-flex-row-container">
                                    Tasks/All
                                </div>
                                <div class="d-flex-row-container">
                                    {{-- <div class="search-bar">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <button class="btn search-btn" type="submit" title="Search">
                                            <span class="material-symbols-rounded">&#xe8b6;</span>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        {{-- <th>
                            <input type="checkbox" id="selectAllTasks" title="Select All">
                        </th> --}}
                        <th>Title</th>
                        {{-- <th>Assigned</th> --}}
                        <th>Status</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Files</th>
                        <th>Due</th>
                        <th></th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                @php
                    $statuses = [
                        'Scheduled' => ['original' => 'Scheduled', 'tag' => 'tag-primary'],
                        'Waiting' => ['original' => 'Waiting', 'tag' => 'tag-grey'],
                        'Processing' => ['original' => 'Processing', 'tag' => 'tag-warning'],
                        'Completed' => ['original' => 'Completed', 'tag' => 'tag-success'],
                    ];
                @endphp

                <tbody>
                    @foreach ($statuses as $displayStatus => $info)
                        @php
                            $TaskStatus = $tasks->where('status', $info['original']);
                        @endphp
                        @foreach ($TaskStatus as $task)
                            <tr>
                                {{-- <td>
                                    <input type="checkbox" id="selectAllTasks" title="Select All">
                                </td> --}}
                                <td>
                                    {{ $task->title }}
                                </td>
                                {{-- <td>
                                    @if (isset($task->issued_to))
                                        <div class="assigned-profile">
                                            <img src="{{ asset('storage/profile/' .  auth()->user()->image) }}" class="profile-img"
                                                style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                            {{ auth()->user()->name }}
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td> --}}
                                <td>
                                    <div
                                        class="tags
                                @if ($task->status === 'Completed') tag-success
                                @elseif ($task->status === 'Processing') tag-warning
                                @elseif ($task->status === 'Waiting') tag-grey
                                @else tag-primary @endif
                            ">
                                        {{ $task->status }}
                                    </div>
                                </td>
                                <td>
                                    @if (isset($task->type))
                                        {{ ucfirst($task->type) }}
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                                <td>
                                    <div
                                        class="tags
                                @if ($task->priority === 'Low') tag-success
                                @elseif ($task->priority === 'Mild') tag-warning
                                @elseif ($task->priority === 'High') tag-danger
                                @else tag-primary @endif
                            ">
                                        {{ $task->priority }}
                                    </div>
                                </td>
                                <td class="files">
                                    @if ($task->files && count($task->files))
                                        <ul>
                                            @foreach ($task->files as $file)
                                                <li>
                                                    <button class="btn-no-bg">
                                                        @php
                                                            $filename = is_string($file)
                                                                ? $file
                                                                : $file->name ?? ($file->filename ?? '');
                                                        @endphp
                                                        @if (Str::endsWith(strtolower($filename), ['.jpg', '.jpeg', '.png', '.gif', '.bmp', '.webp']))
                                                            <span class="material-symbols-rounded"
                                                                style="vertical-align:middle;">image</span>
                                                        @elseif(Str::endsWith(strtolower($filename), ['.pdf', '.docx', '.doc', '.txt']))
                                                            <span class="material-symbols-rounded"
                                                                style="vertical-align:middle;">attach_file</span>
                                                        @else
                                                            <span class="material-symbols-rounded"
                                                                style="vertical-align:middle;">insert_drive_file</span>
                                                        @endif
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($task->deadline))
                                        <span class="convertDate"
                                            data-date="{{ $task->deadline }}">{{ $task->deadline }}</span>
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-no-bg">
                                            <span class="material-symbols-rounded"
                                                style="vertical-align:middle;">description</span>
                                        </button>
                                        <button class="btn-no-bg" title="Edit Task">
                                            <span class="material-symbols-rounded">edit</span>
                                        </button>
                                        <button class="btn-no-bg" title="Delete Task">
                                            <span class="material-symbols-rounded">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
