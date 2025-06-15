@extends('pages.layouts.Main')

@section('title', 'Profile')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container card">
            @if (auth()->check())
                <div class="d-flex-row-container">
                    <img src="{{ 'storage/profile/' . auth()->user()->image }}" alt="" class="profile">
                    <div class="info">
                        <h2>{{ auth()->user()->name }}</h2>
                        <p>{{ auth()->user()->role }} | {{ auth()->user()->position }}</p>
                        <p>{{ auth()->user()->email }} | {{ auth()->user()->contact }} | {{ auth()->user()->location }}</p>
                    </div>
                </div>
            @endif
            <div class="d-flex-row-container top">
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
                                            <span class="material-symbols-rounded" style="vertical-align:middle;">description</span>
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

    <style>
        .profile {
            height: 100px;
            width: 100px;
            border-radius: 9px;
        }

        .top {
            align-self: start !important;
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 1px
        }
    </style>
@endsection
