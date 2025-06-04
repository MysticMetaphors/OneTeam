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
            <div></div>
            <div class="d-flex-row-container">
                <button class="btn btn-no-bg create-project-btn" title="Create Project">
                    <span class="material-symbols-rounded">&#xe147;</span>
                    Create Project
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
        <div class="table-container">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">
                                    <button class="btn btn-sm btn-outline-secondary" id="bulkCompleteBtn"
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
                                    </button>

                                </div>
                                <div class="d-flex-row-container">
                                    <select class="input-filter" id="statusFilter" style="width:auto;">
                                        <option value="">All Status</option>
                                        <option value="Open">Open</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                    <select class="input-filter " id="priorityFilter" style="width:auto;">
                                        <option value="">All Priority</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
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
                        <th>
                            <input type="checkbox" id="selectAllTasks" title="Select All">
                        </th>
                        <th>Description</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Files</th>
                        <th>Created At</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>
                                <input type="checkbox" id="selectAllTasks" title="Select All">
                            </td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if (isset($task->assigned_to))
                                    <div class="assigned-profile">
                                        <img src="{{ asset('storage/images/default-profile.png') }}" class="profile-img"
                                            style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                        <span>{{ $task->assigned_to }}</span>
                                    </div>
                                @else
                                    <span>—</span>
                                @endif
                            </td>
                            <td>
                                <div
                                    class="tags
                                @if ($task->status === 'Open') tag-success
                                @elseif ($task->status === 'In Progress') tag-warning
                                @elseif ($task->status === 'Closed') tag-danger
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
                            <td><span class="convertDate" data-date="{{ $task->created_at }}">{{ $task->created_at }}</span>
                            </td>
                            <td>
                                @if (isset($task->deadline))
                                    {{-- {{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d H:i') }} --}}
                                    <span class="convertDate" data-date="{{ $task->deadline }}">{{ $task->deadline }}</span>
                                @else
                                    <span>—</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex-row-container">
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
                </tbody>
            </table>
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
    </style>
@endsection
