@extends('pages.layouts.Main')

@section('title', 'Tasks')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container page-header">
            <h1 class="page-title">Task List</h1>
            <button class="theme-toggle">
                <span class="material-symbols-rounded" id="moonIcon">&#xe518;</span>
                <span class="material-symbols-rounded" id="sunIcon" style="display: none;">&#xe51c;</span>
            </button>
        </div>
        <table class="table table-striped tasks-table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Type</th>
                    <th>Assigned To</th>
                    <th>Files</th>
                    <th>Deadline</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>
                            @if (isset($task->type))
                                {{ ucfirst($task->type) }}
                            @else
                                <span>—</span>
                            @endif
                        </td>
                        <td>{{ $task->assigned_to }}</td>
                        <td>
                            @if ($task->files && count($task->files))
                                <ul>
                                    @foreach ($task->files as $file)
                                        <li>
                                            <a href="{{ asset('storage/' . $file->path) }}"
                                                target="_blank">{{ $file->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span>No files</span>
                            @endif
                        </td>
                        <td>
                            @if (isset($task->deadline))
                                {{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d H:i') }}
                            @else
                                <span>—</span>
                            @endif
                        </td>
                        <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="kanban-board" style="display: flex; gap: 20px;">
            <!-- Today Column -->
            <div class="kanban-column" style="flex: 1; background: #f5f5f5; border-radius: 8px; padding: 16px;">
            <h3>Today</h3>
            <div class="kanban-tasks">
                <!-- Example Task Card -->
                <div class="kanban-card" style="background: #fff; margin-bottom: 12px; padding: 16px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <div>Task 1 for Today</div>
                    <small style="color: #888;">Due: 10:00 AM</small>
                </div>
            </div>
            </div>
            <!-- Scheduled Column -->
            <div class="kanban-column" style="flex: 1; background: #f5f5f5; border-radius: 8px; padding: 16px;">
            <h3>Scheduled</h3>
            <div class="kanban-tasks">
                <div class="kanban-card" style="background: #fff; margin-bottom: 12px; padding: 16px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <div>Scheduled Task 1</div>
                    <small style="color: #888;">Due: Tomorrow 2:00 PM</small>
                </div>
            </div>
            </div>
            <!-- In Progress Column -->
            <div class="kanban-column" style="flex: 1; background: #f5f5f5; border-radius: 8px; padding: 16px;">
            <h3>In Progress</h3>
            <div class="kanban-tasks">
                <div class="kanban-card" style="background: #fff; margin-bottom: 12px; padding: 16px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <div>In Progress Task 1</div>
                    <small style="color: #888;">Due: Today 5:00 PM</small>
                </div>
            </div>
            </div>
            <!-- Completed Column -->
            <div class="kanban-column" style="flex: 1; background: #f5f5f5; border-radius: 8px; padding: 16px;">
            <h3>Completed</h3>
            <div class="kanban-tasks">
                <div class="kanban-card" style="background: #fff; margin-bottom: 12px; padding: 16px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <div>Completed Task 1</div>
                    <small style="color: #888;">Due: Yesterday 4:00 PM</small>
                </div>
                Completed Task 1
                </div>
            </div>
            </div>
        </div> --}}
    </div>
@endsection
