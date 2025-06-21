<template>
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
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                    @click="goToCreateProject">
                    <span class="material-symbols-rounded">add</span>
                    New project
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

        <div class="project-content">
            <div class="table-container" id="project-table-view">
                <table class="table table-striped projects-table table-responsive">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex-row-container" style="gap: 12px;">
                                    <div class="d-flex-row-container">
                                        Projects/All
                                    </div>
                                    <div class="d-flex-row-container">
                                        <!-- Search bar can be implemented here if needed -->
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Team</th>
                            <th>Task</th>
                            <th>Docs</th>
                            <th>StartDate</th>
                            <th>Due</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(details, status) in statuses" :key="status">
                            <template v-for="project in filteredProjectsByStatus(details.original)" :key="project.id">
                                <tr>
                                    <td>{{ project.name }}</td>
                                    <td>
                                        <div v-if="project.owner" class="profile">
                                            <img :src="profileImage(project.image)" class="profile-img"
                                                style="width:32px;height:32px;border-radius:50%;object-fit:cover;" />
                                            {{ project.owner }}
                                        </div>
                                        <span v-else>—</span>
                                    </td>
                                    <td>
                                        <div class="tags" :class="statusTagClass(project.status)">
                                            {{ project.status }}
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn-no-bg" title="View Team">
                                            <span class="material-symbols-rounded">group</span>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn-no-bg" title="View Tasks" @click="goToTask(project.encrypt)">
                                            <span class="material-symbols-rounded">checklist</span>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn-no-bg" title="View Description">
                                            <span class="material-symbols-rounded">description</span>
                                        </button>
                                    </td>
                                    <td>
                                        <span v-if="project.start_date" class="convertDate"
                                            :data-date="project.start_date">
                                            {{ formatDate(project.start_date) }}
                                        </span>
                                        <span v-else>—</span>
                                    </td>
                                    <td>
                                        <span v-if="project.deadline" class="convertDate" :data-date="project.deadline">
                                            {{ formatDate(project.deadline) }}
                                        </span>
                                        <span v-else>—</span>
                                    </td>
                                    <td>
                                        <div class="d-flex-row-container">
                                            <button class="btn-no-bg" title="Edit Task">
                                                <span class="material-symbols-rounded">edit</span>
                                            </button>
                                            <button class="btn-no-bg" title="Delete Task">
                                                <span class="material-symbols-rounded">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from './layout/MainLayout.vue';
import { route } from 'ziggy-js';

export default {
    layout: MainLayout,
    props: {
        projects: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            statuses: {
                New: { original: "New", tag: "tag-primary" },
                "On hold": { original: "On hold", tag: "tag-primary" },
                "In Progress": { original: "In progress", tag: "tag-warning" },
                Complete: { original: "Complete", tag: "tag-success" },
                Cancelled: { original: "Cancelled", tag: "tag-success" },
            },
        };
    },
    methods: {
        filteredProjectsByStatus(status) {
            return this.projects.filter((p) => p.status === status);
        },
        statusTagClass(status) {
            if (status === "Complete") return "tag-success";
            if (status === "In progress") return "tag-warning";
            if (status === "On hold") return "tag-grey";
            if (status === "Cancelled") return "tag-danger";
            return "tag-primary";
        },
        profileImage(image) {
            // Adjust this path as needed for your storage setup
            return `storage/profile/${image}`;
        },
        goToCreateProject() {
            this.$inertia.visit(route('project.create'));
        },
        goToTask(encrypt) {
            // Replace with your router logic if using Vue Router
            window.location.href = `/task/${encodeURIComponent(encrypt)}`;
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                // hour: 'numeric',
                // minute: '2-digit'
            });
        },
    },
};
</script>

<style scoped>
.profile {
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>
