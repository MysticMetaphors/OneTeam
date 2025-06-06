@extends('pages.layouts.Main')

@section('title', 'Tasks')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            {{-- <div class="search-bar">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn search-btn" type="submit" title="Search">
                    <span class="material-symbols-rounded">&#xe8b6;</span>
                </button>
            </div> --}}
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
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected">
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
                                    {{-- <button class="btn btn-sm btn-outline-secondary" id="bulkCompleteBtn"
                                        title="Add Selected">
                                        <span class="material-symbols-rounded">add</span>
                                        Complete
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary" id="bulkCompleteBtn"
                                        title="edit Selected">
                                        <span class="material-symbols-rounded">edit</span>
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary" id="bulkDeleteBtn"
                                        title="Delete Selected">
                                        <span class="material-symbols-rounded">delete</span>
                                        Delete
                                    </button> --}}
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
                        <th>Description</th>
                        <th>Assigned</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Files</th>
                        <th>Deadline</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                @php
                    $statuses = [
                        'Scheduled' => ['original' => 'Scheduled', 'tag' => 'tag-primary'],
                        'Waiting' => ['original' => 'Waiting', 'tag' => 'tag-grey'],
                        'In Progress' => ['original' => 'In Progress', 'tag' => 'tag-warning'],
                        'Complete' => ['original' => 'Complete', 'tag' => 'tag-success'],
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
                                <td>{{ $task->description }}</td>
                                <td>
                                    @if (isset($task->assigned_to))
                                        <div class="assigned-profile">
                                            <img src="{{ asset('storage/images/default-profile.png') }}" class="profile-img"
                                                style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                        </div>
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                                <td>
                                    <div
                                        class="tags
                                @if ($task->status === 'Complete') tag-success
                                @elseif ($task->status === 'In Progress') tag-warning
                                @elseif ($task->status === 'Waiting') tag-grey
                                @else tag-primary @endif
                            ">
                                        {{ $task->status }}
                                    </div>
                                </td>
                                <td>
                                    @if (isset($task->type))
                                        @if ($task->type == 'recurring')
                                            <span class="material-symbols-rounded">
                                                repeat
                                            </span>
                                        @else
                                            {{ ucfirst($task->type) }}
                                        @endif
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
                                {{-- <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-edit" title="Edit Task">
                                            <span class="material-symbols-rounded">edit</span>
                                        </button>
                                        <button class="btn-delete" title="Delete Task">
                                            <span class="material-symbols-rounded">delete</span>
                                        </button>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="kanban-view" style="margin-top: 32px;">

            <div class="kanban-board">
                {{-- @php
                    $statuses = [
                        'Waiting' => ['original' => 'Waiting', 'tag' => 'tag-grey'],
                        'In Progress' => ['original' => 'In Progress', 'tag' => 'tag-warning'],
                        'Complete' => ['original' => 'Complete', 'tag' => 'tag-success'],
                    ];
                @endphp --}}
                @foreach ($statuses as $displayStatus => $info)
                    <div class="kanban-column">
                        <div class="kanban-column-header">
                            <span>{{ $displayStatus }}</span>
                            <hr>
                        </div>
                        <div class="kanban-tasks">
                            @php
                                $tasksForStatus = $tasks->where('status', $info['original']);
                                $lightColors = [
                                    '#F8BBD0', // light pink
                                    '#81D4FA', // darker light blue
                                    '#FFF3E0', // light orange
                                    '#E8F5E9', // light green
                                    '#F3E5F5', // light purple
                                ];
                            @endphp
                            @forelse ($tasksForStatus as $task)
                                {{-- @php
                                    $color = $lightColors[array_rand($lightColors)];
                                @endphp --}}
                                @php
                                    if ($task->priority === 'High') {
                                        $color = '#F3E5F5'; // light purple
                                    } elseif ($task->priority === 'Mild' || $task->priority === 'Medium') {
                                        $color = '#81D4FA'; // darker light blue
                                    } elseif ($task->status === 'Complete') {
                                        $color = '#E8F5E9'; // light green
                                    } else {
                                        $color = '#FFF3E0'; // default light orange
                                    }
                                @endphp
                                <div class="kanban-task-card" style="background: {{ $color }};">
                                    <div class="d-flex-row-container">
                                        <div class="kanban-task-assigned">
                                            @if (isset($task->assigned_to))
                                                <img src="{{ asset('storage/images/default-profile.png') }}"
                                                    class="profile-img">
                                            @else
                                                <span>—</span>
                                            @endif
                                        </div>
                                        <div class="kanban-task-desc">{{ $task->description }}</div>
                                    </div>


                                    <div class="kanban-task-dates">

                                        <div class="d-flex-row-container">
                                            @if (isset($task->deadline))
                                                <span class="convertDate"
                                                    data-date="{{ $task->deadline }}">{{ $task->deadline }}</span>
                                            @endif
                                            <span class="material-symbols-rounded"
                                                style="vertical-align:middle;">description</span>
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
