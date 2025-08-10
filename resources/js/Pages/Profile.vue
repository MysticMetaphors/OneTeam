<template>
    <div class="main-content">
        <div class="d-flex-row-container card">
            <div v-if="user" class="d-flex-row-container">
                <img :src="`storage/profile/${user.image}`" alt="" class="profile" />
                <div class="info">
                    <h2>{{ user.name }}</h2>
                    <p>{{ user.role }} | {{ user.position }}</p>
                    <p>{{ user.email }} | {{ user.contact }} | {{ user.location }}</p>
                </div>
            </div>
            <div class="d-flex-row-container top">
                <button class="btn btn-no-bg notification-btn" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn btn-no-bg mail-btn" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg">
                    <span class="material-symbols-rounded" id="moonIcon" style="display: none;">&#xe518;</span>
                    <span class="material-symbols-rounded" id="sunIcon">&#xe51c;</span>
                </button>
            </div>
        </div>

        <div class="d-flex-row-container">
            <div class="card">Completed Tasks</div>
            <div class="card">Failed Tasks</div>
            <div class="card">Late Submission</div>
            <div class="card">On time</div>
        </div>

        <div class="table-container">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">⚠️ Due Today</div>
                                <div class="d-flex-row-container">
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(info, displayStatus) in statuses" :key="displayStatus">
                        <template v-for="task in filteredTasks(info.original)" :key="task.id">
                            <tr>
                                <td>{{ task.title }}</td>
                                <td>
                                    <div class="tags" :class="{
                                        'tag-success': task.status === 'Completed',
                                        'tag-warning': task.status === 'Processing',
                                        'tag-grey': task.status === 'Waiting',
                                        'tag-primary': task.status === 'Scheduled'
                                    }">
                                        {{ task.status }}
                                    </div>
                                </td>
                                <td>
                                    <span v-if="task.type">{{ capitalize(task.type) }}</span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div class="tags" :class="{
                                        'tag-success': task.priority === 'Low',
                                        'tag-warning': task.priority === 'Mild',
                                        'tag-danger': task.priority === 'High',
                                        'tag-primary': !['Low', 'Mild', 'High'].includes(task.priority)
                                    }">
                                        {{ task.priority }}
                                    </div>
                                </td>
                                <td class="files">
                                    <template v-if="task.files && task.files.length">
                                        <ul>
                                            <li v-for="(file, idx) in task.files" :key="idx">
                                                <button class="btn-no-bg">
                                                    <span class="material-symbols-rounded"
                                                        style="vertical-align:middle;"
                                                        v-html="fileIcon(getFilename(file))"></span>
                                                </button>
                                            </li>
                                        </ul>
                                    </template>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <span v-if="task.deadline" class="convertDate" :data-date="task.deadline">
                                        {{ formatDate(task.deadline) }}
                                    </span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-no-bg">
                                            <span class="material-symbols-rounded" style="vertical-align:middle;"
                                                @click="openModal(task)">description</span>
                                        </button>
                                        <!-- <button class="btn-no-bg" title="Edit Task">
                                            <span class="material-symbols-rounded">edit</span>
                                        </button>
                                        <button class="btn-no-bg" title="Delete Task">
                                            <span class="material-symbols-rounded">delete</span>
                                        </button> -->
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">Activity Logs</div>
                                <div class="d-flex-row-container">
                                </div>
                            </div>
                        </th>
                    </tr>
                    <!-- <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Files</th>
                        <th>Due</th>
                        <th></th>
                    </tr> -->
                </thead>
                <tbody>
                    <!-- <template v-for="(info, displayStatus) in statuses" :key="displayStatus">
                        <template v-for="task in filteredTasks(info.original)" :key="task.id"> -->
                    <tr v-for="(logs, key) in log" :key="key">
                        <td>{{ logs.ip_address }}</td>
                        <td>{{ logs.user_agent }}</td>
                        <td>{{ logs.created_at }}</td>
                    </tr>
                    <!-- </template>
                    </template> -->
                </tbody>
            </table>
        </div>

        <div id="taskModal" class="modal" v-show="modalOpen">
            <div class="modal-content task-card">
                <h2 class="task-title">{{ modalTask.title }}</h2>
                <p class="task-desc">{{ modalTask.description }}</p>
                <div class="task-meta">
                    <div class="tags tag-success" :class="{
                        'tag-grey': modalTask.status === 'Waiting',
                        'tag-warning': modalTask.status === 'Processing',
                        'tag-success': modalTask.status === 'Completed',
                        'tag-primary': !['Waiting', 'Processing', 'Completed'].includes(modalTask.status)
                    }">
                        {{ modalTask.status }}
                    </div>
                    <div class="tags tags_icon" :class="nearDeadline(modalTask.deadline)">
                        <span class="material-symbols-rounded">calendar_clock</span>
                        {{ formatDate(modalTask.deadline) }}
                    </div>
                </div>
                <form @submit.prevent="submitForm">
                    <div class="task-sub">
                        <div class="checkbox-input" v-for="(sub, idx) in modalTask.subtasks || []" :key="idx">
                            <input type="checkbox" :value="sub.id" :checked="sub.completed" v-model="checkedSubtasks" />
                            <span>{{ sub.title }}</span>
                        </div>
                    </div>

                    <!-- <div class="task-meta" style="margin: 0;">
                        <button class="btn-no-bg task-btn" style="margin: 0;">
                            <span class="material-symbols-rounded" style="vertical-align:middle;">image</span>
                            Files
                        </button>
                        <button class="btn-no-bg task-btn" style="margin: 0;">
                            <span class="material-symbols-rounded" style="vertical-align:middle;">attach_file</span>
                            Attach File
                        </button>
                    </div> -->

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
export default {
    name: "Profile",
    props: {
        user: Object,
        tasks: Array,
        log: Object,
    },
    data() {
        return {
            modalOpen: false,
            modalTask: {},
            statuses: {
                Scheduled: { original: "Scheduled", tag: "tag-primary" },
                Waiting: { original: "Waiting", tag: "tag-grey" },
                Processing: { original: "Processing", tag: "tag-warning" },
                Completed: { original: "Completed", tag: "tag-success" }
            }
        };
    },
    methods: {
        openModal(task) {
            this.modalTask = { ...task };
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.modalTask = {};
        },
        filteredTasks(status) {
            return this.tasks.filter((task) => task.status === status);
        },
        capitalize(str) {
            if (!str) return "";
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        getFilename(file) {
            if (typeof file === "string") return file;
            return file.name || file.filename || "";
        },
        fileIcon(filename) {
            const lower = filename.toLowerCase();
            if (/\.(jpg|jpeg|png|gif|bmp|webp)$/.test(lower)) {
                return "image";
            } else if (/\.(pdf|docx|doc|txt)$/.test(lower)) {
                return "attach_file";
            } else {
                return "insert_drive_file";
            }
        },
        formatDate(dateStr) {
            const date = new Date(dateStr)
            return date.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            })
        },
        nearDeadline(deadline) {
            const now = new Date();
            const taskDeadline = new Date(deadline);
            const timeDiff = taskDeadline - now;
            const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            if (daysDiff <= 3 && daysDiff >= 0) {
                return 'tag-warning';
            } else if (daysDiff > 0) {
                return 'tag-success';
            } else {
                return 'tag-danger'
            }
        }
    }
};
</script>

<style scoped>
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
    gap: 1px;
}

.table-container {
    margin-top: 10px;
}

.task-meta {
    display: flex;
    align-items: center;
    justify-content: left;
    gap: 8px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.task-overview p {
    width: 100%;
    font-size: 14px;
    margin-bottom: 8px;
    text-align: justify;
    color: grey;
}

.tags span {
    font-size: 15px;
    height: 100%;
}
</style>
