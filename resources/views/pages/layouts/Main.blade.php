<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/Navigation.css')
</head>
<body>
    <nav class="sidebar">
        <div class="logo">
            <img src="{{ asset('storage/Black and White Modern Personal Brand Logo.png') }}" alt="Logo">
            Von Bryan
        </div>
        <ul>
            <li class="">
                <div class="parent-menu {{ str_contains($currentRouteName, 'dashboard') ? 'active' : '' }}">
                    <img src="{{ asset('storage/Icons/dashboard_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
            </li>

            <li id="menu" class="has-submenu ">
                <div class="parent-menu" id="menu-con">
                    <img src="assets/icons/Vector-1.png" alt="" class="icon-large">
                    <a href="Product">Task</a>
                    <img src="assets/icons/Vector-4.png" alt="" class="drop-icon toggle-submenu" id="toggle">
                </div>
                <ul class="submenu">
                    <li class="submenu-con ">
                        <img src="assets/icons/Vector-4.png" alt="" class="icon-sub">
                        <a href="Product/add">Assign</a>
                    </li>
                    <li class="submenu-con ">
                        <img src="assets/icons/Vector-4.png" alt="" class="icon-sub">{{-- UPDATE & INCONSTRUCTION --}}
                        <a href="Product/edit">Edit Item</a>
                    </li>
                    <li class="submenu-con ">
                        <img src="assets/icons/Vector-4.png" alt="" class="icon-sub">{{-- UPDATE & INCONSTRUCTION --}}
                        <a href="Product/stock">Stock Item</a>
                    </li>
                </ul>
            </li>

            <li class="">
                <div class="parent-menu {{ str_contains($currentRouteName, 'technologies') ? 'active' : '' }}">
                    <img src="{{ asset('storage/Icons/code_32dp_000000_FILL0_wght400_GRAD0_opsz40.svg') }}"
                        class="icon-large">
                    <a href="{{ route('technologies') }}">My Team</a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/code_blocks_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="Dashboard">Reports</a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/contacts_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="Dashboard"></a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/notifications_active_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="Dashboard">Notifications</a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/monitoring_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="Dashboard">Reports</a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/inventory_2_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="Dashboard">Activities</a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/inventory_2_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="Dashboard">Archives</a>
                </div>
            </li>

            <li class="">
                <div class="parent-menu">
                    <img src="{{ asset('storage/Icons/logout_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg') }}"
                        class="icon-large">
                    <a href="{{ route('home') }}">Logout</a>
                </div>
            </li>

            <li style="pointer-events: none;"></li>
            <li style="pointer-events: none;"></li>
        </ul>
    </nav>
    @yield('content')
</body>
</html>
