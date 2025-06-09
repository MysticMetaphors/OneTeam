@extends('pages.layouts.Main')

@section('title', 'Profile')

@section('content')
<div class="main-content">
    <div class="d-flex-row-container">
@if (auth()->check())
<img src="{{'storage/profile/'.auth()->user()->image}}" alt="" class="profile-img">
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>Your email: {{ auth()->user()->email }}</p>
@endif
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
                        <th>Title</th>
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
                                    <span class="material-symbols-rounded" style="vertical-align:middle;">description</span>
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
                        <th>Title</th>
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
                                    <span class="material-symbols-rounded" style="vertical-align:middle;">description</span>
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
    </div>
</div>
@endsection
