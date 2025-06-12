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
        <div class="table-container" id="task-table-view">

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
