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
            <div class="card">Total Assigned</div>
            <div class="card">Late Submission</div>
            <div class="card">On time</div>
        </div>

        <div class="table-container">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">To-Do Today</div>
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
                    <template v-for="(info, displayStatus) in statuses" :key="displayStatus">
                        <template v-for="task in filteredTasks(info.original)" :key="task.id">
                            <tr>
                                <td>{{ task.title }}</td>
                                <td>
                                    <div
                                        class="tags"
                                        :class="{
                                            'tag-success': task.status === 'Completed',
                                            'tag-warning': task.status === 'Processing',
                                            'tag-grey': task.status === 'Waiting',
                                            'tag-primary': task.status === 'Scheduled'
                                        }"
                                    >
                                        {{ task.status }}
                                    </div>
                                </td>
                                <td>
                                    <span v-if="task.type">{{ capitalize(task.type) }}</span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div
                                        class="tags"
                                        :class="{
                                            'tag-success': task.priority === 'Low',
                                            'tag-warning': task.priority === 'Mild',
                                            'tag-danger': task.priority === 'High',
                                            'tag-primary': !['Low', 'Mild', 'High'].includes(task.priority)
                                        }"
                                    >
                                        {{ task.priority }}
                                    </div>
                                </td>
                                <td class="files">
                                    <template v-if="task.files && task.files.length">
                                        <ul>
                                            <li v-for="(file, idx) in task.files" :key="idx">
                                                <button class="btn-no-bg">
                                                    <span
                                                        class="material-symbols-rounded"
                                                        style="vertical-align:middle;"
                                                        v-html="fileIcon(getFilename(file))"
                                                    ></span>
                                                </button>
                                            </li>
                                        </ul>
                                    </template>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <span v-if="task.deadline" class="convertDate" :data-date="task.deadline">
                                        {{ task.deadline }}
                                    </span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-no-bg">
                                            <span class="material-symbols-rounded" style="vertical-align:middle;">description</span>
                                        </button>
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

        <div class="table-container">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">Log Activity</div>
                                <div class="d-flex-row-container">
                                </div>
                            </div>
                        </th>
                    </tr>
                    <!-- <tr>
                        <th>login</th>
                        <th>logout</th>
                        <th>Ip</th>
                        <th>user_agent</th>
                        <th>status</th>
                    </tr> -->
                </thead>
                <tbody>
                    <template v-for="(info, displayStatus) in statuses" :key="displayStatus">
                        <template v-for="task in filteredTasks(info.original)" :key="task.id">
                            <tr>
                                <td>{{ task.title }}</td>
                                <td>
                                    <div
                                        class="tags"
                                        :class="{
                                            'tag-success': task.status === 'Completed',
                                            'tag-warning': task.status === 'Processing',
                                            'tag-grey': task.status === 'Waiting',
                                            'tag-primary': task.status === 'Scheduled'
                                        }"
                                    >
                                        {{ task.status }}
                                    </div>
                                </td>
                                <td>
                                    <span v-if="task.type">{{ capitalize(task.type) }}</span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div
                                        class="tags"
                                        :class="{
                                            'tag-success': task.priority === 'Low',
                                            'tag-warning': task.priority === 'Mild',
                                            'tag-danger': task.priority === 'High',
                                            'tag-primary': !['Low', 'Mild', 'High'].includes(task.priority)
                                        }"
                                    >
                                        {{ task.priority }}
                                    </div>
                                </td>
                                <td class="files">
                                    <template v-if="task.files && task.files.length">
                                        <ul>
                                            <li v-for="(file, idx) in task.files" :key="idx">
                                                <button class="btn-no-bg">
                                                    <span
                                                        class="material-symbols-rounded"
                                                        style="vertical-align:middle;"
                                                        v-html="fileIcon(getFilename(file))"
                                                    ></span>
                                                </button>
                                            </li>
                                        </ul>
                                    </template>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <span v-if="task.deadline" class="convertDate" :data-date="task.deadline">
                                        {{ task.deadline }}
                                    </span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-no-bg">
                                            <span class="material-symbols-rounded" style="vertical-align:middle;">description</span>
                                        </button>
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
</template>

<script>
export default {
    name: "Profile",
    props: {
        user: Object,
        tasks: Array
    },
    data() {
        return {
            // statuses: {
            //     Scheduled: { original: "Scheduled", tag: "tag-primary" },
            //     Waiting: { original: "Waiting", tag: "tag-grey" },
            //     Processing: { original: "Processing", tag: "tag-warning" },
            //     Completed: { original: "Completed", tag: "tag-success" }
            // }
        };
    },
    methods: {
        // filteredTasks(status) {
        //     return this.tasks.filter((task) => task.status === status);
        // },
        // capitalize(str) {
        //     if (!str) return "";
        //     return str.charAt(0).toUpperCase() + str.slice(1);
        // },
        // getFilename(file) {
        //     if (typeof file === "string") return file;
        //     return file.name || file.filename || "";
        // },
        // fileIcon(filename) {
        //     const lower = filename.toLowerCase();
        //     if (/\.(jpg|jpeg|png|gif|bmp|webp)$/.test(lower)) {
        //         return "image";
        //     } else if (/\.(pdf|docx|doc|txt)$/.test(lower)) {
        //         return "attach_file";
        //     } else {
        //         return "insert_drive_file";
        //     }
        // }
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
    margin-top: 20px;
}
</style>
