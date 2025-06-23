<script>
import MainLayout from './layout/MainLayout.vue';

export default {
    layout: MainLayout,
    setup(props) {
        const tasks = Object.values(props.task)
        return {
            tasks,
            statuses: props.statuses
        }
    },
    props: {
        task: Object,
        project: Object,
        // activity: Object,
        statuses: {
            type: Object,
            required: true
        }
    },
    methods: {
        filterTasks(statusName) {
            return this.tasks.filter(task => task.status === statusName)
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                // hour: 'numeric',
                // minute: '2-digit'
            });

        }
    }

}
</script>

<template>

        <div class="main-content">
            <div class="d-flex-row-container page-header card top-panel">
                <div></div>
                <div class="d-flex-row-container">
                    <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                        @click="goToProjectCreate">
                        <span class="material-symbols-rounded">add</span>
                        New project
                    </button>
                    <button class="btn notification-btn btn-no-bg" title="Notifications">
                        <span class="material-symbols-rounded">&#xe7f4;</span>
                    </button>
                    <button class="btn mail-btn btn-no-bg" title="Mail">
                        <span class="material-symbols-rounded">&#xe158;</span>
                    </button>
                    <!-- <button class="theme-toggle btn-no-bg" @click="toggleTheme">
                        <span class="material-symbols-rounded" v-show="theme === 'light'" id="sunIcon">&#xe51c;</span>
                        <span class="material-symbols-rounded" v-show="theme === 'dark'" id="moonIcon">&#xe518;</span>
                    </button> -->
                </div>
            </div>

            <div class="d-flex-row-container">
                <div class="card">Completed Tasks</div>
                <div class="card">Total Assigned</div>
                <div class="card">Late Submission</div>
                <div class="card">On time</div>
            </div>

            <div class="table-container" id="task-table-view">
                <table class="table table-striped tasks-table table-responsive">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex-row-container" style="gap: 12px;">
                                    <div class="d-flex-row-container">
                                        Tasks/All
                                    </div>
                                    <div class="d-flex-row-container">
                                        <!-- Search bar can be implemented here -->
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Files</th>
                            <th>Due</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <template v-for="(statusInfo, displayStatus) in statuses" :key="displayStatus">
                        <template v-for="task in statusInfo.original" :key="tasks.id"> -->
                        <!-- {{ task }} -->
                        <template v-for="task in tasks" :key="tasks.id">
                            <tr>
                                <td>{{ task.title }}</td>
                                <td>
                                    <div class="tags" :class="{
                                        'tag-success': task.status === 'Completed',
                                        'tag-warning': task.status === 'Processing',
                                        'tag-grey': task.status === 'Waiting',
                                        'tag-primary': !['Completed', 'Processing', 'Waiting'].includes(task.status)
                                    }">
                                        {{ task.status }}
                                    </div>
                                </td>
                                <td>
                                    <span v-if="task.type">{{ task.type }}</span>
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
                                    <ul v-if="task.files && task.files.length">
                                        <li v-for="(file, idx) in task.files" :key="idx">
                                            <button class="btn-no-bg">
                                                <span class="material-symbols-rounded" style="vertical-align:middle;"
                                                    v-html="fileIcon(file)"></span>
                                            </button>
                                        </li>
                                    </ul>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <span v-if="task.deadline" class="convertDate">{{ formatDate(task.deadline)
                                        }}</span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-no-bg">
                                            <span class="material-symbols-rounded"
                                                style="vertical-align:middle;">description</span>
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

                        <!-- </template>
                    </template> -->
                    </tbody>
                </table>
            </div>
        </div>

</template>
