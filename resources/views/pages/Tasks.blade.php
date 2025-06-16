@extends('pages.layouts.Main')

@section('title', 'Tasks')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div class="d-flex-row-container">
                <button class="btn-no-bg" id="kanban-view-btn" title="Kanban View">
                    <span class="material-symbols-rounded">view_kanban</span>
                    Kanban View
                </button>
                <button class="btn-no-bg btn-border" id="task-view-btn" title="Table View">
                    <span class="material-symbols-rounded">table</span>
                    Table View
                </button>
            </div>
            <div class="d-flex-row-container">
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                    onclick="window.location.href='{{ route('task.create') }}'">
                    <span class="material-symbols-rounded">add</span>
                    New Task
                </button>
                <button class="btn btn-no-bg notification-btn" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn btn-no-bg mail-btn" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg">
                    <span class="material-symbols-rounded" id="moonIcon" style="display: none;">&#xe518;</span>
                    <span class="material-symbols-rounded" id="sunIcon">&#xe51c; </span>
                </button>
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
                                    <div class="search-bar">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <button class="btn search-btn" type="submit" title="Search">
                                            <span class="material-symbols-rounded">&#xe8b6;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        {{-- <th>
                            <input type="checkbox" id="selectAllTasks" title="Select All">
                        </th> --}}
                        <th>Title</th>
                        <th>Assigned</th>
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
                            @php
                                $user = $users->where('id', $task->issued_to)->first();
                            @endphp
                            <tr>
                                {{-- <td>
                                    <input type="checkbox" id="selectAllTasks" title="Select All">
                                </td> --}}
                                <td>
                                    {{ $task->title }}
                                </td>
                                <td>
                                    @if (isset($task->issued_to))
                                        <div class="assigned-profile">
                                            <img src="{{ asset('storage/profile/' . $user->image) }}" class="profile-img"
                                                style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                            {{ $user->name }}
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
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
                                        <button class="btn-no-bg" title="Task Description"
                                            onclick="openModal('taskModal'
                                            ,'{{ $task->title }}'
                                            ,'{{ $task->description }}'
                                            ,'{{ $task->attachment }}'
                                            ,'{{ $task->deadline }}')">
                                            <span class="material-symbols-rounded">description</span>
                                        </button>
                                        @if (Auth::user()->role == 'Admin')
                                            <button class="btn-no-bg" title="Edit Task">
                                                <span class="material-symbols-rounded">edit</span>
                                            </button>
                                            <button class="btn-no-bg" title="Delete Task">
                                                <span class="material-symbols-rounded">delete</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="kanban-view" style="margin-top: 32px;">
            <div class="kanban-board">
                @foreach ($statuses as $displayStatus => $info)
                    <div class="kanban-column">
                        <div class="kanban-column-header">
                            <span>{{ $displayStatus }}</span>
                            <hr>
                        </div>
                        <div class="kanban-tasks">
                            @php
                                $tasksForStatus = $tasks->where('status', $info['original']);
                            @endphp
                            @forelse ($tasksForStatus as $task)
                                @php
                                    $user = $users->where('id', $task->issued_to)->first();
                                @endphp
                                @php
                                    if ($task->priority === 'High') {
                                        $color = '#FFCDD2'; // light redish
                                    } elseif ($task->priority === 'Medium') {
                                        $color = '#FFF3E0'; // light orange
                                    } elseif ($task->status === 'Completed') {
                                        $color = '#E8F5E9';
                                    } else {
                                        $color = '#81D4FA';
                                    }
                                @endphp
                                <div class="kanban-task-card" style="background: {{ $color }};">
                                    <div class="d-flex-row-container">
                                        <div class="kanban-task-assigned">
                                            @if (isset($task->issued_to))
                                                <img src="{{ asset('storage/profile/' . $user->image) }}"
                                                    class="profile-img">
                                            @else
                                                <span>—</span>
                                            @endif
                                        </div>
                                        <div class="kanban-task-desc">{{ $task->title }}</div>
                                    </div>


                                    <div class="kanban-task-dates">

                                        <div class="d-flex-row-container">
                                            @if (isset($task->deadline))
                                                <span class="convertDate"
                                                    data-date="{{ $task->deadline }}">{{ $task->deadline }}</span>
                                            @endif
                                            <div>
                                                <span class="material-symbols-rounded">description</span>
                                                @if ($task->type == 'true')
                                                    <span class="material-symbols-rounded">repeat</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="kanban-no-tasks">No tasks</div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="taskModal" class="modal">
        <div class="modal-content task-card">
            <h2 class="task-title">Campaign Strategy Development</h2>
            <p class="task-desc">
                The marketing team is tasked with developing a comprehensive strategy for an upcoming product launch. The
                goal is to create a campaign that effectively targets…
            </p>

            <button class="btn-no-bg">
                <span class="material-symbols-rounded" style="vertical-align:middle;">image</span>
                Attachments
            </button>

            <div class="task-meta">
                <div>
                    <strong>Tags:</strong>
                    <span class="tag purple">Development</span>
                    <span class="tag green">Marketing</span>
                </div>
                <div>
                    <strong>Status:</strong>
                    <span class="tag yellow">In Progress</span>
                </div>
            </div>

            <div class="task-progress">
                <strong>Task Progress</strong>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 50%;"></div>
                </div>
                <span class="progress-text">50%</span>
            </div>

            <div class="task-footer">
                <div class="task-stats">
                    <span>📋 4/8</span>
                    <span>💬 7</span>
                    <span>📎 3</span>
                </div>
                <div class="task-date">
                    06-05-2024
                </div>
            </div>

            {{-- <span class="material-symbols-rounded">attachment</span> --}}
            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <div class="modal-btns">
                    <button type="button" data-modal-close>Cancel</button>
                    <button type="submit">Complete</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .assigned-profile {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .files ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .files a {
            text-decoration: none;
            color: #007bff;
        }

        .grey {
            pointer-events: none;
            filter: grayscale(60%)
        }

        table ul {
            display: flex;
            flex-direction: row;
            gap: 8px;
        }

        .btn-no-bg {
            padding: 0;
            cursor: pointer;
        }

        .btn-border {
            border-bottom: 2px solid var(--font-color);
            border-radius: 0px;
        }
    </style>
@endsection
