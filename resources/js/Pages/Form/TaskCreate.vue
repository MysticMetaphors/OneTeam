<template>
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div></div>
            <div class="d-flex-row-container">
                <!-- Uncomment and implement navigation if needed
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" title="Add Selected" @click="goToCreate">
                    <span class="material-symbols-rounded">add</span>
                    New project
                </button>
                -->
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
        <form @submit.prevent="submitForm" enctype="multipart/form-data" enc>
            <h2>New Task</h2>
            <div v-show="message" class="text-success">{{ message }}</div>

            <div class="form-direction-row">
                <input type="text" name="title" placeholder="Title" v-model="form.title" />
                <input type="text" name="type" placeholder="Type" v-model="form.type" />
            </div>

            <textarea name="description" placeholder="Description" rows="4" v-model="form.description"></textarea>

            <div class="form-direction-row">
                <div class="form-direction-row input-icon">
                    <select name="priority" v-model="form.priority">
                        <option hidden value="">Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <span class="material-symbols-rounded">expand_more</span>
                </div>
                <div class="form-direction-row input-icon">
                    <label for="deadline">Due</label>
                    <input type="date" id="deadline" name="deadline" v-model="form.deadline" />
                </div>
            </div>

            <div class="form-direction-row">
                <div class="form-direction-row input-icon">
                    <select name="project" v-model="form.project">
                        <option hidden value="">Project</option>
                        <option v-for="project in projects" :key="project.id" :value="project.id">
                            {{ project.name }}
                        </option>
                    </select>
                    <span class="material-symbols-rounded">expand_more</span>
                </div>

                <div class="form-direction-row input-icon">
                    <select name="assignee" v-model="form.assignee">
                        <option hidden value="">Assign To</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                    <span class="material-symbols-rounded">expand_more</span>
                </div>
            </div>

            <div>
                <button type="button" @click="addSub" class="btn-no-bg">Add SubTasks</button>
                <div id="subtasks">
                    <div v-for="(sub, i) in form.sub" :key="i" class="form-direction-row input-icon">
                        <span class="material-symbols-rounded" @click="removeSub(i)"
                            style="cursor: pointer;">remove</span>
                        <input type="text" placeholder="Subtask" v-model="form.sub[i]" />
                    </div>
                </div>
            </div>

            <div>
                <label for="attach" class="attachment">Attachment</label>
                <div class="form-direction-row input-icon">
                    <input type="file" name="attach" @change="handleFile" />
                    <span class="material-symbols-rounded">attachment</span>
                </div>
            </div>

            <div class="checkbox-input">
                <input type="checkbox" id="check" name="recurring" @click="toggleInput" />
                <span>Repeat?</span>
            </div>

            <div class="form-direction-row input-icon">
                <input type="number" name="repeat_interval" placeholder="Number days before repeat" id="interval"
                    v-show="recurring" v-model="form.repeat_interval" />
            </div>

            <div class="form-direction-row">
                <button type="button" @click="cancel">
                    Cancel
                </button>
                <button type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>

</template>

<script>
import { route } from 'ziggy-js';
import apiClient from '../../axios';
import MainLayout from '../layout/MainLayout.vue';

export default {
    layout: MainLayout,
    props: {
        projects: Object,
        users: Object
    },
    data() {
        return {
            form: {
                title: '',
                type: '',
                description: '',
                priority: '',
                deadline: '',
                project: '',
                assignee: '',
                sub: [],
                attach: [],
                repeat_interval: [],
            },
            recurring: false,
            message: '',
            projects: this.$props.projects,
            user: this.$props.user,
        };
    },
    methods: {
        toggleInput() {
            this.recurring = !this.recurring;
        },
        fieldError(field) {
            return this.errors.some((e) => e.toLowerCase().includes(field));
        },
        addSub() {
            this.form.sub.push('');
        },
        removeSub(i) {
            this.form.sub.splice(i, 1);
        },
        handleFile(e) {
            this.form.attach = e.target.files[0];
        },
        cancel() {
            this.$inertia.visit(route('task'))
        },
        async submitForm() {
            try {
                await apiClient.get('/sanctum/csrf-cookie');

                const formData = new FormData();
                console.log('Form values:', this.form);

                formData.append("title", this.form.title);
                formData.append("assignee", this.form.assignee);
                formData.append("deadline", this.form.deadline);
                formData.append("description", this.form.description);
                formData.append("priority", this.form.priority);
                formData.append("project", this.form.project);
                formData.append("type", this.form.type);
                formData.append("repeat_interval", this.form.repeat_interval);
                formData.append('attach', this.form.attach);

                if (Array.isArray(this.form.sub) && this.form.sub.length !== 0) {
                    this.form.sub.forEach((subtask, id) => {
                        formData.append(`sub[${id}]`, subtask);
                    });
                } else {
                    formData.append("sub", this.form.sub)
                }

                console.log('FormData entries:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ':', pair[1]);
                }

                const response = await apiClient.post(route('task.store'), formData);
                this.message = response.data.message
                this.$inertia.visit(route('task.create'));
            } catch (errors) {
                console.log('error: ', errors);
            }
        },
    },
};
</script>
