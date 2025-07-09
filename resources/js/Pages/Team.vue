<template>
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div>{{ this.project ? 'Team/' + this.project : 'All Users' }}</div>
            <div class="d-flex-row-container">
                <button v-if="!project" class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn"
                    title="Add Selected" @click="goToCreateUser">
                    <span class="material-symbols-rounded">add</span>
                    New Member
                </button>
                <button v-else class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn"
                    title="Add Selected" @click="toggleModal">
                    <span class="material-symbols-rounded">add</span>
                    Assign Member
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
                            <!-- <th>User</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Position</th>
                            <th>Location</th>
                            <th>Birthdate At</th>
                            <th>Contact</th> -->
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
            <!-- <div v-if="project" class="card">
                <div class="d-flex-row-container">
                    <h5>All Members</h5>
                </div>
                <div>

                </div>
                <span>

                </span>
            </div> -->
        </div>
    </div>

    <div v-if="all_users" id="addUser" class="modal" v-show="modalOpen" @click="toggleModal">
        <div class="modal-content task-card" @click="$event.stopPropagation()">
            <h2>Assign user</h2>
            <ul>
               <li v-for="user in all_users" :key="user.id" class="d-flex-row-container">
                    <div class="profile">
                        <img :src="profileImage(user.image)" class="profile-img" />
                    </div>
                    <div class="d-flex-column-container">
                        <span>{{ user.name }}</span>
                        <!-- <span>{{ user.email }}</span> -->
                    </div>
                    <button class="btn btn-sm btn-outline-secondary btn-no-bg" @click="toggleModal">
                        <span class="material-symbols-rounded">add</span>
                        Assign
                    </button>
               </li>
            </ul>
            <form method="post" @submit.prevent="addNew">
                <div class="d-flex-row-container">
                    <button type="button" @click="toggleModal">Close</button>
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { route } from 'ziggy-js';
import MainLayout from './layout/MainLayout.vue';
import { all } from 'axios';

export default {
    layout: MainLayout,
    props: {
        users: Object,
        all_users: Object,
        project: String,
    },
    data() {
        return {
            // search: "",
            all_users: this.$props.all_users,
            users: this.$props.users,
            modalOpen: false,
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
        toggleModal() {
            this.modalOpen = !this.modalOpen;
        }

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



.table-container {
    width: 100%;
    overflow-x: auto;
}
</style>
