@php
    $currentRouteName = Route::currentRouteName();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0">
    @vite('resources/css/Main.css')
    @vite('resources/js/app.js')
</head>

<body class="lightmode">
    <aside class="sidebar">
        <!-- Sidebar header -->
        <header class="sidebar-header">
            <a href="#" class="header-logo">
                <img src="{{ asset('storage/images/FAVICON-removebg-preview.png') }}" alt="Logo"
                    style="height: 40px;">
            </a>
            <button class="toggler sidebar-toggler">
                <span class="material-symbols-rounded">chevron_left</span>
            </button>
            <button class="toggler menu-toggler">
                <span class="material-symbols-rounded">menu</span>
            </button>
        </header>

        <nav class="sidebar-nav">
            <!-- Primary top nav -->
            <ul class="nav-list primary-nav">
                <li class="nav-item ">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ $currentRouteName === 'dashboard' ? 'active' : '' }}">
                        <span class="nav-icon material-symbols-rounded">dashboard</span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <span class="nav-tooltip">Dashboard</span>
                </li>
                <li class="nav-item has-submenu">
                    <a href="{{ route('task') }}" class="nav-link {{ $currentRouteName === 'task' ? 'active' : '' }}">
                        <span class="nav-icon material-symbols-rounded">check_circle</span>
                        <span class="nav-label">Task</span>

                    </a>
                    <span
                        class="submenu-arrow material-symbols-rounded submenu-toggler {{ $currentRouteName === 'task' ? 'active' : '' }}">expand_more</span>
                    <span class="nav-tooltip">Task</span>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href=""
                                class="submenu-link {{ $currentRouteName === 'recurring' ? 'active' : '' }}">
                                <span class="material-symbols-rounded"
                                    style="vertical-align: middle;">chevron_right</span>
                                Recurring
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-submenu">
                    <a href="{{ route('project') }}"
                        class="nav-link {{ $currentRouteName === 'project' ? 'active' : '' }}">
                        <span class="nav-icon material-symbols-rounded">folder</span>
                        <span class="nav-label">Projects</span>

                    </a>
                    <span
                        class="submenu-arrow material-symbols-rounded submenu-toggler {{ $currentRouteName === 'project' ? 'active' : '' }}">expand_more</span>
                    <span class="nav-tooltip">Projects</span>
                    <ul class="submenu">
                        @foreach ($projects as $project)
                            <li class="submenu-item">
                                <a href="" {{-- {{ route('project.show', $project->id) }} --}}
                                    class="submenu-link {{ $currentRouteName === 'project.show' ? 'active' : '' }}">
                                    <span class="material-symbols-rounded"
                                        style="vertical-align: middle;">chevron_right</span>
                                    {{ $project->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">group</span>
                        <span class="nav-label">Team</span>
                    </a>
                    <span class="nav-tooltip">Team</span>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">forum</span>
                        <span class="nav-label">Discussion</span>
                    </a>
                    <span class="nav-tooltip">Discussion</span>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">insert_chart</span>
                        <span class="nav-label">Reports</span>
                    </a>
                    <span class="nav-tooltip">Reports</span>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">history</span>
                        <span class="nav-label">Activity Logs</span>
                    </a>
                    <span class="nav-tooltip">Activity Logs</span>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">settings</span>
                        <span class="nav-label">Settings</span>
                    </a>
                    <span class="nav-tooltip">Settings</span>
                </li>
            </ul>
            <!-- Secondary bottom nav -->
            <div class="divider"></div>
            <ul class="nav-list secondary-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('storage/profile/' . Auth::user()->image) }}" alt=""
                            class="profile-img">
                        <span class="nav-label">Profile</span>
                    </a>
                    <span class="nav-tooltip">Profile</span>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">logout</span>
                        <span class="nav-label" id="openModalBtn">Logout</span>
                    </a>
                    <span class="nav-tooltip">Logout</span>
                </li>
            </ul>
        </nav>
    </aside>
    </ul>
    </nav>

    @yield('content')
</body>
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>Are you sure?</h2>
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <div class="modal-btns">
                <button type="button">No</button>
                <button type="submit">Yes</button>
            </div>
        </form>
    </div>
</div>

</html>
