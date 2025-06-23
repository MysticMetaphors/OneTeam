<template>
 <div class="table-container" id="task-table-view">
            <table class="table table-striped tasks-table table-responsive">
                <thead>
                    <tr>
                        <th colspan="10">
                            <div class="d-flex-row-container" style="gap: 12px;">
                                <div class="d-flex-row-container">
                                    Tasks/All
                                </div>
                                <div class="d-flex-row-container"></div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <th>Assigned</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Files</th>
                        <th>Due</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <template v-for="(info, displayStatus) in statuses" :key="displayStatus">
                        <template v-for="task in tasksByStatus(info.original)" :key="task.id">
                            <tr>
                                <td>{{ task.title }}</td>
                                <td>
                                    <div v-if="task.issued_to" class="assigned-profile">
                                        <img :src="profileImage(task.issued_to)" class="profile-img"
                                            style="width:32px;height:32px;border-radius:50%;object-fit:cover;" />
                                        {{ userName(task.issued_to) }}
                                    </div>
                                    <span v-else>-</span>
                                </td>
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
                                                        style="vertical-align:middle;" v-html="fileIcon(file)"></span>
                                                </button>
                                            </li>
                                        </ul>
                                    </template>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <span v-if="task.deadline" class="convertDate" :data-date="task.deadline">{{
                                        formatDate(task.deadline) }}</span>
                                    <span v-else>—</span>
                                </td>
                                <td>
                                    <div class="d-flex-row-container">
                                        <button class="btn-no-bg" title="Task Description" @click="openModal(task)">
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
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>
</template>

<script>
export default {
    props: {
        headers: {
            text: String,
            require: true
        },
        data: {
            text: String,
            require: true
        },
        is_bg: false
    },
    data() {
        return {

        }
    }
}
</script>
