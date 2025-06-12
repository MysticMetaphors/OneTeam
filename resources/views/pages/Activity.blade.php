@extends('pages.layouts.Main')

@section('title', 'Activities')

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

        <div class="act-content">
            <div class="table-container" id="act-table-view">
                <table class="table table-striped acts-table table-responsive">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex-row-container" style="gap: 12px;">

                                    <div class="d-flex-row-container">
                                        Activity
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
                    </thead>
                    <tbody>
                        @foreach ($activity as $act)
                            @php
                                $user = $users->where('id', $act->made_by);
                            @endphp

                            <tr>
                                {{-- <td>
                                    <input type="checkbox" id="selectAllacts" title="Select All">
                                </td> --}}
                                <td>{{ $act->title }}</td>
                                <td>
                                    @if (isset($user))
                                        <div class="profile">
                                            <img src="{{ asset('storage/profile/' . $user[0]['image']) }}"
                                                class="profile-img"
                                                style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                            {{ $user[0]['name'] }}
                                        </div>
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                                <td>
                                    <div
                                        class="tags
                                @if ($act->type === 'Project') tag-success
                                @else tag-primary @endif
                            ">
                                        {{ $act->type }}
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="tags
                                @if ($act->action === 'Create') tag-success
                                @elseif ($act->action === 'Update') tag-warning
                                @elseif ($act->action === 'Destroy') tag-danger
                                @else tag-primary @endif
                            ">
                                        {{ $act->action }}
                                    </div>
                                </td>
                                <td>
                                    @if (isset($act->created_at))
                                        <span class="convertDate"
                                            data-date="{{ $act->created_at }}">{{ $act->created_at }}</span>
                                    @else
                                        <span>—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="act-tool">
            <ul class="act-nav">
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
