<template>
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div></div>
            <div class="d-flex-row-container">
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn"
                    title="Add Selected" @click="goToCreateUser">
                    <span class="material-symbols-rounded">add</span>
                    New Member
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

        <div class="d-flex-row-container">
            <div class="table-container" id="task-table-view">
                <table class="table table-striped tasks-table table-responsive">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex-row-container" style="gap: 12px;">
                                    {{ this.project ? this.project : 'All Members' }}
                                    <div class="d-flex-row-container">
                                        <!-- Bulk edit/delete buttons can be added here -->
                                    </div>
                                    <div class="d-flex-row-container">
                                        <!-- <div class="search-bar">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Search..."
                                            v-model="search"
                                        />
                                        <button class="btn search-btn" type="submit" title="Search">
                                            <span class="material-symbols-rounded">&#xe8b6;</span>
                                        </button>
                                    </div> -->
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>User</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Position</th>
                            <th>Location</th>
                            <th>Birthdate At</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in filteredUsers" :key="user.id">
                            <td>
                                <img :src="profileImage(user.image)" class="profile-img" />
                            </td>
                            <td>{{ user.name }}</td>
                            <td><span>{{ user.email }}</span></td>
                            <td>{{ user.role }}</td>
                            <td>{{ user.position }}</td>
                            <td><span>{{ user.location }}</span></td>
                            <td class="convertDate" :data-date="user.birthdate">{{ user.birthdate }}</td>
                            <td>{{ user.contact }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card ">
                <div class="d-flex-row-container">
                    <h3>All Members</h3>
                </div>
                <div>

                </div>
                <span>

                </span>
            </div>
        </div>
    </div>
</template>

<script>
import { route } from 'ziggy-js';
import MainLayout from './layout/MainLayout.vue';

export default {
    layout: MainLayout,
    props: {
        users: Object,
        project: String,
    },
    data() {
        return {
            // search: "",
            users: this.$props.users
        };
    },
    computed: {
        filteredUsers() {
            if (!this.search) return this.users;
            const s = this.search.toLowerCase();
            return this.users.filter(
                (u) =>
                    u.name.toLowerCase().includes(s) ||
                    u.email.toLowerCase().includes(s) ||
                    u.role.toLowerCase().includes(s) ||
                    u.position.toLowerCase().includes(s) ||
                    u.location.toLowerCase().includes(s) ||
                    (u.contact && u.contact.toLowerCase().includes(s))
            );
        },
    },
    methods: {
        goToCreateUser() {
            this.$inertia.visit(route('user.create'))
        },
        profileImage(image) {
            return `storage/profile/${image}`;
        },

    },
    mounted() {
        // Fetch users here or receive as props
        // Example: this.users = this.$page.props.users;
    },
};
</script>

<style scoped>
.card,
.table-container {
    align-self: flex-start;
}
</style>
