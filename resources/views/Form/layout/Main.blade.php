@extends('pages.layouts.Main')

@section('content')
    <div class="main-content">
        @vite('resources/css/Forms.css')
        <div class="d-flex-row-container page-header card top-panel">
            <div></div>
            <div class="d-flex-row-container">
                {{-- <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                    onclick="window.location.href='{{ route('project.create') }}'">
                    <span class="material-symbols-rounded">add</span>
                    New project
                </button> --}}
                <button class="btn notification-btn btn-no-bg" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn mail-btn btn-no-bg" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg">
                    <span class="material-symbols-rounded" id="sunIcon" style="display: none;">&#xe51c;</span>
                    <span class="material-symbols-rounded" id="moonIcon">&#xe518;</span>
                </button>
            </div>
        </div>
        @yield('form-content')
    </div>
@endsection
