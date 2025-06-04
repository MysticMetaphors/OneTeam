@extends('pages.layouts.Main')

@section('title', 'Activities')

@section('content')
<div class="main-content">
     <div class="d-flex-row-container page-header card top-panel">
        <div></div>
            <div class="d-flex-row-container">
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected">
                    <span class="material-symbols-rounded">add</span>
                    Add Member
                </button>
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

          <div class="table-container" id="task-table-view">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">
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
                        <th>User</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th>Birthdate At</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @php
                    $statuses = [
                        'Waiting' => ['original' => 'Waiting', 'tag' => 'tag-grey'],
                        'In Progress' => ['original' => 'In Progress', 'tag' => 'tag-warning'],
                        'Complete' => ['original' => 'Complete', 'tag' => 'tag-success'],
                    ];
                @endphp

                <tbody>
                   @foreach ($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" class="task-checkbox" data-task-id="{{ $user->id }}">
                            </td>
                            <td>
                                <img src="{{ asset('storage/images/default-profile.png') }}" class="profile-img">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td><span>{{ $user->email }}</span></td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->position }}</td>
                            <td><span>{{ $user->location }}</span></td>
                            <td class="convertDate" data-date="{{ $user->birthdate }}">{{ $user->birthdate }}</td>
                            <td>{{ $user->contact }}</td>
                            <td class="d-flex-row-container">
                                <button class="btn-no-bg" title="Edit User">
                                    <span class="material-symbols-rounded">edit</span>
                                </button>
                                <button class="btn-no-bg" title="Delete User">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
</div>
@endsection
