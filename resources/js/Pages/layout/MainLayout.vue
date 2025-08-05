<template>
    <aside class="sidebar menu-active">
        <!-- Sidebar header -->
        <header class="sidebar-header">
            <a href="#" class="header-logo">
                <img src="/storage/app/public/images/FAVICON-removebg-preview.png" alt="Logo" style="height: 40px;">
            </a>
            <button class="toggler sidebar-toggler" @click="toggleSidebar">
                <span class="material-symbols-rounded">chevron_left</span>
            </button>
            <button class="toggler menu-toggler">
                <span class="material-symbols-rounded">menu</span>
            </button>
        </header>

        <nav class="sidebar-nav">
            <!-- Primary top nav -->

            <ul class="nav-list primary-nav">
                <!-- <li class="nav-item">
                    <Link :href="route('dashboard')" class="nav-link">
                    <span class="nav-icon material-symbols-rounded">dashboard</span>
                    <span class="nav-label">Dashboard</span>
                    </Link>
                    <span class="nav-tooltip">Dashboard</span>
                </li> -->

                <li class="nav-item">
                    <Link :href="route('project')" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">folder</span>
                        <span class="nav-label">Projects</span>
                    </Link>
                    <!-- <Link v-else :href="route('project.show')" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">folder</span>
                        <span class="nav-label">Projects</span>
                    </Link> -->
                    <span class="nav-tooltip">Projects</span>
                    <span class="submenu-arrow material-symbols-rounded submenu-toggler" @click="toggleSubmenu">expand_more</span>
                    <ul class="submenu">

                        <li class="submenu-item" v-for="project in projects" :key="project.encrypt">
                            <a :href="`/project/${project.encrypt}`" class="submenu-link">
                                <span class="material-symbols-rounded"
                                    style="vertical-align: middle;">tag</span>
                                {{ project.name }}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-submenu">
                    <Link :href="route('task')" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">check_circle</span>
                        <span class="nav-label">Task</span>
                    </Link>
                    <span class="submenu-arrow material-symbols-rounded submenu-toggler" @click="toggleSubmenu">expand_more</span>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="#" class="submenu-link">
                                <span class="material-symbols-rounded"
                                    style="vertical-align: middle;">chevron_right</span>
                                Today
                            </a>
                             <a href="#" class="submenu-link">
                                <span class="material-symbols-rounded"
                                    style="vertical-align: middle;">chevron_right</span>
                                Repeating
                            </a>
                        </li>
                    </ul>
                </li>

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <Link :href="route('user')" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">group</span>
                        <span class="nav-label">Team</span>
                    </Link>
                    <span class="nav-tooltip">Team</span>
                </li>

                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">forum</span>
                        <span class="nav-label">Discussion</span>
                    </a>
                    <span class="nav-tooltip">Discussion</span>
                </li> -->

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon material-symbols-rounded">insert_chart</span>
                        <span class="nav-label">Reports</span>
                    </a>
                    <span class="nav-tooltip">Reports</span>
                </li>

                <li v-if="user.role === 'Admin'" class="nav-item">
                    <Link :href="route('activity')" class="nav-link">
                    <span class="nav-icon material-symbols-rounded">history</span>
                    <span class="nav-label">History</span>
                    </Link>
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
                    <Link :href="route('user.profile')" class="nav-link">
                        <img :src="`storage/profile/${user.image}`" alt="" class="profile-img">
                        <span class="nav-label">Profile</span>
                    </Link>
                    <span class="nav-tooltip">Profile</span>
                </li>
                <li class="nav-item" @click="toggleModal()">
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

    <div class="modal" v-show="toggled == true">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <form @submit.prevent="handleLogout" enctype="multipart/form-data">
                <div class="modal-btns">
                    <button type="button" @click="toggleModal()" data-modal-close>No</button>
                    <button type="submit">Yes</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { usePage, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import apiClient from '../../axios'
// import { router } from '@inertiajs/vue3'

export default {
    name: 'MainLayout',
    props: {
        projects: Object
    },
    data() {
        return {
            toggled: false
        }
    },
    setup() {
        const page = usePage()
        const user = page.props.auth.user
        return {
            user,

        }
    },
    methods: {
        toggleModal() {
            console.log(this.toggled)
            this.toggled = !this.toggled
        },

        async handleLogout() {
            try {
                await apiClient.get('/sanctum/csrf-cookie');
                await apiClient.post(route('user.logout'));
                this.$inertia.visit(route('login'));
            } catch (error) {
                console.error('Logout failed:', error);
            }
        },
        toggleSidebar() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.classList.toggle("collapsed");
        },
        toggleMenu() {
            const sidebar = document.querySelector(".sidebar");
            const menuToggler = document.querySelector(".menu-toggler");
            const isMenuActive = sidebar.classList.toggle("menu-active");
            sidebar.style.height = isMenuActive ? `${sidebar.scrollHeight}px` : "56px";
            menuToggler.querySelector("span").innerText = isMenuActive ? "menu" : "close";
        },
        toggleSubmenu(event) {
            const submenu = event.currentTarget.nextElementSibling;
            submenu.style.display = submenu.style.display === "block" ? "none" : "block";
            const arrow = event.currentTarget;
            console.log(arrow)
            arrow.classList.toggle("rotate");
        }
    },
    mounted() {
        const sidebar = document.querySelector(".sidebar");
        const menuToggler = document.querySelector(".menu-toggler");
        const fullSidebarHeight = "calc(100vh - 32px)";

        menuToggler.addEventListener("click", this.toggleMenu);

        window.addEventListener("resize", () => {
            if (window.innerWidth >= 1024) {
                sidebar.style.height = fullSidebarHeight;
            } else {
                sidebar.classList.remove("collapsed");
                sidebar.style.height = "auto";
                if (sidebar.classList.contains("menu-active")) {
                    sidebar.style.height = `${sidebar.scrollHeight}px`;
                }
            }
        });
    },
    components: {
        Link,
    }
}
</script>
