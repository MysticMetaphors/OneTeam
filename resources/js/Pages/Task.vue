<template>
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div class="d-flex-row-container">
                Task/All
            </div>
            <div class="d-flex-row-container">
                <button class="btn-no-bg" id="kanban-view-btn" title="Kanban View" @click="showKanban = true">
                    <span class="material-symbols-rounded">view_kanban</span>
                    Kanban View
                </button>
                <button class="btn-no-bg btn-border" id="task-view-btn" title="Table View" @click="showKanban = false">
                    <span class="material-symbols-rounded">table</span>
                    Table View
                </button>
                <button v-if="currentUser.role === 'Admin'" class="btn btn-sm btn-outline-secondary btn-no-bg"
                    id="bulkCompleteBtn" title="Add Selected" @click="goToCreateTask(project ?? null)">
                    <span class="material-symbols-rounded">add</span>
                    New Task
                </button>
                <button class="btn btn-no-bg notification-btn" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn btn-no-bg mail-btn" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg" @click="toggleTheme">
                    <span class="material-symbols-rounded" id="moonIcon" v-show="theme === 'dark'">&#xe518;</span>
                    <span class="material-symbols-rounded" id="sunIcon" v-show="theme === 'light'">&#xe51c;</span>
                </button>
            </div>
        </div>

        <div class="d-flex-row-container contents">
            <div v-show="!showKanban" class="table-container" id="task-table-view">
                <template v-for="(info, displayStatus) in statuses" :key="displayStatus">
                    <template v-for="task in tasksByStatus(info.original)" :key="task.id">
                        <div @click="openModal(task)" class="task-row d-flex-row-container">
                            <div class="task-meta">
                                <span class="material-symbols-rounded check-circle">
                                    check_circle
                                </span>
                                <h2>{{ priorityClass(task.priority) }}</h2>
                                {{ task.title }}
                                <div class="tags" :class="statusClass(task.status)">
                                    {{ task.status }}
                                </div>
                                <!-- <div class="tags" :class="{
                                'tag-success': task.priority === 'Low',
                                'tag-warning': task.priority === 'Mild',
                                'tag-danger': task.priority === 'High',
                                'tag-primary': !['Low', 'Mild', 'High'].includes(task.priority)
                            }">
                                {{ task.priority }}
                            </div> -->
                            </div>

                            <div class="task-meta">
                                <span v-if="task.type">{{ capitalize(task.type) }}</span>
                                <span v-else>—</span>

                                <div v-if="task.issued_to" class="assigned-profile">
                                    <img :src="profileImage(task.issued_to)" class="profile-img"
                                        style="width:32px;height:32px;border-radius:50%;object-fit:cover;" />
                                    <!-- {{ userName(task.issued_to) }} -->
                                </div>
                                <span v-else>-</span>

                                <template v-if="task.files && task.files.length">
                                    <ul>
                                        <li v-for="(file, idx) in task.files" :key="idx">
                                            <button class="btn-no-bg">
                                                <span class="material-symbols-rounded" style="vertical-align:middle;"
                                                    v-html="fileIcon(file)"></span>
                                            </button>
                                        </li>
                                    </ul>
                                </template>

                                <span v-if="task.deadline" class="convertDate" :data-date="task.deadline">{{
                                    formatDate(task.deadline) }}</span>
                                <span v-else>—</span>
                            </div>

                            <!--<div class="d-flex-row-container">
                                        <button class="btn-no-bg" title="Task Description">
                                            <span class="material-symbols-rounded">description</span>
                                        </button>
                                         <button v-if="currentUser.role === 'Admin'" class="btn-no-bg" title="Edit Task"
                                            @click="editTask(task)">
                                            <span class="material-symbols-rounded">edit</span>
                                        </button>
                                        <button v-if="currentUser.role === 'Admin'" class="btn-no-bg"
                                            title="Delete Task" @click="deleteTask(task)">
                                            <span class="material-symbols-rounded">delete</span>
                                        </button>
                                    </div>-->

                        </div>
                    </template>
                </template>
            </div>

            <div v-show="showKanban" id="kanban-view" style="margin-top: 32px;flex-grow: 1;">
                <div class="kanban-board">
                    <div class="kanban-column" v-for="(info, displayStatus) in statuses" :key="displayStatus">
                        <div class="kanban-column-header">
                            <span>{{ displayStatus }}</span>
                            <hr />
                        </div>
                        <div class="kanban-tasks">
                            <template v-if="tasksByStatus(info.original).length">
                                <div class="kanban-task-card" v-for="task in tasksByStatus(info.original)"
                                    :key="task.id" :style="{ background: kanbanCardColor(task) }">
                                    <div class="d-flex-row-container">
                                        <div class="kanban-task-assigned">
                                            <img v-if="task.issued_to" :src="profileImage(task.issued_to)"
                                                class="profile-img" />
                                            <span v-else>—</span>
                                        </div>
                                        <div class="kanban-task-desc">{{ task.title }}</div>
                                    </div>
                                    <div class="kanban-task-dates">
                                        <div class="d-flex-row-container">
                                            <span v-if="task.deadline" class="convertDate" :data-date="task.deadline">{{
                                                formatDate(task.deadline) }}</span>
                                            <div>
                                                <button class="btn-no-bg" title="Task Description"
                                                    @click="openModal(task)">
                                                    <span class="material-symbols-rounded">description</span>
                                                </button>
                                                <span v-if="task.type === 'true'"
                                                    class="material-symbols-rounded">repeat</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div v-else class="kanban-no-tasks">No tasks</div>
                        </div>
                    </div>
                </div>
            </div>
 <!-- {{ tasks ? tasks : 'null' }} -->
            <div class="card task-overview">
                <h3>Create Homepage</h3>
                <!-- <br> -->
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae perferendis repellendus corporis,
                    aliquam
                    nobis non molestias temporibus est asperiores libero voluptate incidunt qui necessitatibus assumenda
                    nihil, sed
                    aliquid? Inventore, odio!</p>
                <!-- <br> -->
                <h3>Subtask</h3>
                <div v-for="i in 2" :key="i" class="d-flex-row-container subtask">
                    <span class="material-symbols-rounded">check_circle</span>
                    Subtask {{ i }}
                </div>
                <!-- <br> -->
                <h3>Attachments</h3>
                <div v-for="i in 2" :key="i" class="d-flex-row-container subtask">
                    <span class="material-symbols-rounded">attach_file</span>
                    attach_file {{ i }}
                </div>
            </div>
        </div>

        <div id="taskModal" class="modal" v-show="modalOpen">
            <div class="modal-content task-card">
                <h2 class="task-title">{{ modalTask.title }}</h2>
                <p class="task-desc">{{ modalTask.description }}</p>
                <hr />
                <div class="task-sub">
                    <div class="checkbox-input" v-for="(sub, idx) in modalTask.subtasks || []" :key="idx">
                        <input type="checkbox" :checked="sub.completed" disabled />
                        <span>{{ sub.title }}</span>
                    </div>
                </div>
                <button class="btn-no-bg task-btn">
                    <span class="material-symbols-rounded" style="vertical-align:middle;">image</span>
                    Attachments
                </button>
                <div class="attachments">
                    <div class="attachment-card"></div>
                </div>
                <div class="task-meta">
                    <div>
                        <strong>Status:</strong>
                        <span class="tag modal-tag">{{ modalTask.status }}</span>
                    </div>
                    <div>
                        <strong>Due:</strong>
                        <span class="task-date">{{ formatDate(modalTask.deadline) }}</span>
                    </div>
                </div>
                <form @submit.prevent="closeModal">
                    <div class="modal-btns">
                        <button type="button" @click="closeModal">Cancel</button>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { route } from 'ziggy-js';
import MainLayout from './layout/MainLayout.vue';
import OneButton from './Component/OneButton.vue';
import OneSelect from './Component/OneSelect.vue';

export default {
    layout: MainLayout,
    components: {
        OneButton,
        OneSelect
    },
    props: {
        users: Object,
        tasks: Object,
        project: String,
        encrypt: String,
    },
    data() {
        return {
            showKanban: false,
            theme: "light",
            modalOpen: false,
            modalTask: {},
            currentUser: this.$page.props.auth.user,
            statuses: {
                "Scheduled": { original: "Scheduled", tag: "tag-primary" },
                "Waiting": { original: "Waiting", tag: "tag-grey" },
                "Processing": { original: "Processing", tag: "tag-warning" },
                "Completed": { original: "Completed", tag: "tag-success" },
                // "Cancelled": { original: "Cancelled", tag: "tag-danger" }
            },
            taskPriority: null,
        };
    },
    methods: {
        statusClass(status) {
            switch (status) {
                case 'Completed':
                    return 'tag-success';
                case 'Processing':
                    return 'tag-warning';
                case 'Waiting':
                    return 'tag-grey';
                default:
                    return 'tag-primary';
            }
        },
        priorityClass(priority) {
            switch (priority) {
                case 'High':
                    return '🔴';
                case 'Medium':
                    return '🟡';
                case 'Low':
                    return '🟢';
                default:
                    return '🔵';
            }
        },
        goToCreateTask(prj) {
            if (prj == null) {
                console.log("No project selected, redirecting to create task page");
                this.$inertia.visit(route('task.create'));
            } else {
                this.$inertia.visit(route('task.c', prj));
            }
        },
        statusTagClass(status) {
            if (status === "Complete") return "tag-success";
            if (status === "Processing") return "tag-warning";
            if (status === "Waiting") return "tag-grey";
            if (status === "Cancelled") return "tag-danger";
            return "tag-primary";
        },
        toggleTheme() {
            this.theme = this.theme === "light" ? "dark" : "light";
        },
        tasksByStatus(status) {
            return this.tasks.filter((t) => t.status === status);
        },
        formatDate(dateStr) {
            const date = new Date(dateStr)
            return date.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            })
        },
        profileImage(userId) {
            if (this.users) {
                const user = this.users.find((u) => u.id === userId);
                return user ? `storage/profile/${user.image}` : "";
            }
            return `storage/profile/${this.currentUser.image}`;
        },
        userName(userId) {
            if (this.users) {
                const user = this.users.find((u) => u.id === userId);
                return user ? user.name : "";
            }
            return this.currentUser.name;
        },
        capitalize(str) {
            if (!str) return "";
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        fileIcon(file) {
            let filename = typeof file === "string"
                ? file
                : file.name || file.filename || "";
            filename = filename.toLowerCase();
            if (/\.(jpg|jpeg|png|gif|bmp|webp)$/.test(filename)) {
                return "image";
            } else if (/\.(pdf|docx|doc|txt)$/.test(filename)) {
                return "attach_file";
            } else {
                return "insert_drive_file";
            }
        },
        kanbanCardColor(task) {
            if (task.priority === "High") return "#FFCDD2";
            if (task.priority === "Medium") return "#FFF3E0";
            if (task.status === "Completed") return "#E8F5E9";
            return "#81D4FA";
        },
        openModal(task) {
            this.modalTask = { ...task };
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.modalTask = {};
        },
        editTask(task) {
            // Implement edit logic
            alert("Edit Task: " + task.title);
        },
        deleteTask(task) {
            // Implement delete logic
            alert("Delete Task: " + task.title);
        },
    },
};
</script>

<style scoped>
.assigned-profile {
    display: flex;
    align-items: center;
    gap: 8px;
}

.files ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.files a {
    text-decoration: none;
    color: #007bff;
}

.grey {
    pointer-events: none;
    filter: grayscale(60%);
}

table ul {
    display: flex;
    flex-direction: row;
    gap: 8px;
}

.btn-no-bg {
    padding: 0;
    cursor: pointer;
}

.btn-border {
    border-bottom: 2px solid var(--font-color);
    border-radius: 0px;
}

.modal-content {
    min-width: 400px;
}

.check-circle {
    cursor: pointer;
}

.task-row {
    padding: 10px;
    font-size: 14px;
}

.task-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.task-overview {
    /* min-width: 446.28px; */
    /* flex-grow: 1; */
    flex: none;
    align-self: flex-start;
    height: 84%;
    position: fixed;
    right: 20px;
    overflow-y: scroll;
    scrollbar-width: none;
    min-width: 233px;
    max-width: 233px;
}

.task-overview h3 {
    margin-bottom: 8px;
}

.task-overview p {
    width: 100%;
    font-size: 14px;
     margin-bottom: 8px;
}

.subtask {
    justify-content: flex-start;
    padding: 8px 0;
}

.table-container {
    flex-grow: 1;
    align-self: flex-start;
}

form {
    all: unset;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
</style>
