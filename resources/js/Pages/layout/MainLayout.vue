<template>
    <aside class="sidebar">
        <!-- Sidebar header -->
        <header class="sidebar-header">
            <a href="#" class="header-logo">
                <img src="/storage/app/public/images/FAVICON-removebg-preview.png" alt="Logo" style="height: 40px;">
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
                <li class="nav-item" :class="{ active: currentRouteName === 'dashboard' }">
                    <a href="route('dashboard')" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">dashboard</span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <span class="nav-tooltip">Dashboard</span>
                </li>

                <li v-if="user.role === 'Admin'" class="nav-item has-submenu">
                    <a href="/project" class="nav-link" :class="{ active: currentRouteName === 'project' }">
                        <span class="nav-icon material-symbols-rounded">folder</span>
                        <span class="nav-label">Projects</span>
                    </a>
                    <span class="submenu-arrow material-symbols-rounded submenu-toggler"
                        :class="{ active: currentRouteName === 'project' }">expand_more</span>
                    <span class="nav-tooltip">Projects</span>
                    <ul class="submenu">
                        <li class="submenu-item" v-for="project in projects" :key="project.encrypt">
                            <a :href="`/project/${project.encrypt}`" class="submenu-link"
                                :class="{ active: currentRouteName === 'project.show' }">
                                <span class="material-symbols-rounded"
                                    style="vertical-align: middle;">chevron_right</span>
                                {{ project.name }}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-submenu">
                    <a href="/task" class="nav-link" :class="{ active: currentRouteName === 'task' }">
                        <span class="nav-icon material-symbols-rounded">check_circle</span>
                        <span class="nav-label">Task</span>
                    </a>
                    <span class="submenu-arrow material-symbols-rounded submenu-toggler"
                        :class="{ active: currentRouteName === 'task' }">expand_more</span>
                    <span class="nav-tooltip">Task</span>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="#" class="submenu-link" :class="{ active: currentRouteName === 'recurring' }">
                                <span class="material-symbols-rounded"
                                    style="vertical-align: middle;">chevron_right</span>
                                Recurring
                            </a>
                        </li>
                    </ul>
                </li>

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <a href="/user" class="nav-link">
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

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">insert_chart</span>
                        <span class="nav-label">Reports</span>
                    </a>
                    <span class="nav-tooltip">Reports</span>
                </li>

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <a href="/activity" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">history</span>
                        <span class="nav-label">History</span>
                    </a>
                    <span class="nav-tooltip">History</span>
                </li>

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">settings</span>
                        <span class="nav-label">Settings</span>
                    </a>
                    <span class="nav-tooltip">Settings</span>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">description</span>
                        <span class="nav-label">Documentation</span>
                    </a>
                    <span class="nav-tooltip">Documentation</span>
                </li>
            </ul>
            <!-- Secondary bottom nav -->
            <div class="divider"></div>
            <ul class="nav-list secondary-nav">
                <li class="nav-item">
                    <a href="/user/profile" class="nav-link">
                        <img :src="`storage/profile/${user.image}`" alt="" class="profile-img">
                        <span class="nav-label">Profile</span>
                    </a>
                    <span class="nav-tooltip">Profile</span>
                </li>
                <li class="nav-item" @click="toggleModal(true)">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">logout</span>
                        <span class="nav-label">Logout</span>
                    </a>
                    <span class="nav-tooltip">Logout</span>
                </li>
            </ul>
        </nav>
    </aside>

    <slot />

    <div id="loginModal" class="modal v-b-modal">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <form @submit.prevent="handleLogout">
                <div class="modal-btns">
                    <button type="button" @click="toggleModal(false)" data-modal-close>No</button>
                    <button type="submit">Yes</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import apiClient from '../../axios'
// import { router } from '@inertiajs/vue3'

export default {
    name: 'MainLayout',
    setup() {
        const page = usePage()
        const user = page.props.auth.user

        return {
            user
        }
    },
    methods: {
        toggleModal(status) {
            const modal = document.getElementById('loginModal');
            if (status) {
                modal.style.display = 'block';
            } else {
                modal.style.display = 'none';
            }
        },

        async handleLogout() {
            try {
                await apiClient.post(route('user.logout'));
                this.$inertia.visit(route('login'));
            } catch (error) {
                console.error('Logout failed:', error);
            }
        }
    }
}
</script>
