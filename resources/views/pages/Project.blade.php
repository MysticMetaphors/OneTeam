@extends('pages.layouts.Main')

@section('title', 'Project')

@section('content')
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div class="d-flex-row-container">
                <button class="btn-no-bg" title="Team View">
                    <span class="material-symbols-rounded">group</span>
                    Team
                </button>
                <button class="btn-no-bg btn-border" title="Task Table View">
                    <span class="material-symbols-rounded">checklist</span>
                    View Task
                </button>
            </div>
            <div class="d-flex-row-container">
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                    onclick="window.location.href='{{ route('project.create') }}'">
                    <span class="material-symbols-rounded">add</span>
                    New project
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

        <div class="project-content">
            <div class="table-container" id="project-table-view">
                <table class="table table-striped projects-table table-responsive">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex-row-container" style="gap: 12px;">

                                    <div class="d-flex-row-container">
                                        Projects/All
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
                            <th>Name</th>
                            {{-- <th>Description</th> --}}
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Team</th>
                            <th>Task</th>
                            <th>Docs</th>
                            <th>StartDate</th>
                            <th>Due</th>
                            <th></th>
                        </tr>
                    </thead>
                    @php
                        $statuses = [
                            'New' => ['original' => 'New', 'tag' => 'tag-primary'],
                            'On hold' => ['original' => 'On hold', 'tag' => 'tag-primary'],
                            'In Progress' => ['original' => 'In progress', 'tag' => 'tag-warning'],
                            'Complete' => ['original' => 'Complete', 'tag' => 'tag-success'],
                            'Cancelled' => ['original' => 'Cancelled', 'tag' => 'tag-success'],
                        ];
                    @endphp
                    <tbody>
                        @foreach ($statuses as $status => $details)
                            @php
                                $projectsDetail = $projects->where('status', $details['original']);
                            @endphp
                            @foreach ($projectsDetail as $project)
                                <tr>
                                    {{-- <td>
                                    <input type="checkbox" id="selectAllprojects" title="Select All">
                                </td> --}}
                                    <td>{{ $project->name }}</td>
                                    {{-- <td>{{ $project->description }}</td> --}}
                                    <td>
                                        @if (isset($project->owner))
                                            <div class="profile">
                                                <img src="{{ asset('storage/profile/' . $project->image) }}"
                                                    class="profile-img"
                                                    style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                                {{ $project->owner }}
                                            </div>
                                        @else
                                            <span>—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div
                                            class="tags
                                @if ($project->status === 'Complete') tag-success
                                @elseif ($project->status === 'In progress') tag-warning
                                @elseif ($project->status === 'On hold') tag-grey
                                @elseif ($project->status === 'Cancelled') tag-danger
                                @else tag-primary @endif
                            ">
                                            {{ $project->status }}
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn-no-bg" title="View Team">
                                            <span class="material-symbols-rounded">group</span>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn-no-bg" title="View Tasks"
                                            onclick="window.location.href='{{ route('task.show', ['id' => urlencode($project->encrypt)]) }}'">
                                            <span class="material-symbols-rounded">checklist</span>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn-no-bg" title="View Description">
                                            <span class="material-symbols-rounded">description</span>
                                        </button>
                                    </td>
                                    <td>
                                        @if (isset($project->start_date))
                                            <span class="convertDate"
                                                data-date="{{ $project->start_date }}">{{ $project->start_date }}</span>
                                        @else
                                            <span>—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($project->deadline))
                                            <span class="convertDate"
                                                data-date="{{ $project->deadline }}">{{ $project->deadline }}</span>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="project-tool">
            <ul class="project-nav">
                <span class="nav-icon material-symbols-rounded">folder</span>
                <span class="nav-icon material-symbols-rounded">edit_square</span>
                <span class="nav-icon material-symbols-rounded">sell</span>
                <span class="nav-icon material-symbols-rounded">sell</span>
                <span class="nav-icon material-symbols-rounded">folder</span>
                <span class="nav-icon material-symbols-rounded">Delete</span>
            </ul>
        </div> --}}
    </div>

    <style>
        .profile {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
@endsection
