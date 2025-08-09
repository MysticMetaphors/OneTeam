<template>
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div></div>
            <div class="d-flex-row-container">
                <button class="btn notification-btn btn-no-bg" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn mail-btn btn-no-bg" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg" @click="toggleTheme">
                    <span class="material-symbols-rounded" v-show="theme === 'light'" id="sunIcon">&#xe51c;</span>
                    <span class="material-symbols-rounded" v-show="theme === 'dark'" id="moonIcon">&#xe518;</span>
                </button>
            </div>
        </div>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <h2>Create Project</h2>
            <!-- <div v-show="message" class="text-success">{{ message }}</div> -->
            <OneToast v-if="message" :message="message" />
            <div class="toast-container">
                <OneToast v-for="(msg, index) in errors[0]" :key="index" :message="msg[0]" theme="error"
                    :append="true" />
            </div>
            <div class="form-direction-row">
                <input type="text" name="name" placeholder="Name" v-model="form.name"
                    :class="{ 'input-error': errors.name }" />
                <input type="text" name="owner" placeholder="Owner's Name" v-model="form.owner"
                    :class="{ 'input-error': errors.owner }" />
            </div>
            <div class="form-direction-row">
                <div class="form-direction-row input-icon" :class="{ 'input-error': errors.image }">
                    <input type="file" name="image" @change="onFileChange" />
                    <span class="material-symbols-rounded">image</span>
                </div>
                <div class="form-direction-row input-icon" :class="{ 'input-error': errors.status }">
                    <select name="status" v-model="form.status">
                        <option hidden value="">Select Status</option>
                        <option value="New">New</option>
                        <option value="On hold">On hold</option>
                        <option value="In progress">In progress</option>
                        <option value="Complete">Complete</option>
                    </select>
                    <span class="material-symbols-rounded">expand_more</span>
                </div>
            </div>
            <textarea name="description" placeholder="Description" rows="4" v-model="form.description"
                :class="{ 'input-error': errors.description }"></textarea>
            <div class="form-direction-row">
                <div class="form-direction-row input-icon">
                    <label for="start_date">Start</label>
                    <input type="date" id="start_date" name="start_date" v-model="form.start_date"
                        :class="{ 'input-error': errors.start_date }" />
                </div>
                <div class="form-direction-row input-icon">
                    <label for="deadline">Due</label>
                    <input type="date" id="deadline" name="deadline" v-model="form.deadline"
                        :class="{ 'input-error': errors.deadline }" />
                </div>
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
import OneToast from '../Component/OneToast.vue';
import MainLayout from '../layout/MainLayout.vue';

export default {
    layout: MainLayout,
    components: {
        OneToast
    },
    data() {
        return {
            form: {
                name: "",
                owner: "",
                image: null,
                status: "",
                description: "",
                start_date: "",
                deadline: "",
            },
            errors: [],
            message: '',
            theme: "dark",
        };
    },

    methods: {
        onFileChange(e) {
            this.form.image = e.target.files[0];
        },
        async submitForm() {
            try {
                await apiClient.get('/sanctum/csrf-cookie');

                const formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('owner', this.form.owner);
                formData.append('image', this.form.image);
                formData.append('status', this.form.status);
                formData.append('description', this.form.description);
                formData.append('start_date', this.form.start_date);
                formData.append('deadline', this.form.deadline);
                const response = await apiClient.post(route('project.store'), formData);
                if (this.errors.length > 0) {
                    this.errors = [];
                }
                this.message = response.data.message;
                console.log(this.message);
                this.form = {
                    name: "",
                    owner: "",
                    image: null,
                    status: "",
                    description: "",
                    start_date: "",
                    deadline: "",
                };
                // this.$inertia.visit(route('project.create'));
            } catch (error) {
                this.errors.push(error.response.data.errors);
                console.error(error);
            }
            setTimeout(() => {
                if (this.errors) {
                    this.errors = [];
                }
                if (this.message) {
                    this.message = '';
                }
            }, 2000)
        },
        cancel() {
            this.$router.push({ name: "project" });
        },
        toggleTheme() {
            this.theme = this.theme === "dark" ? "light" : "dark";
        },
        // goToCreate() {
        //   this.$router.push({ name: "project.create" });
        // },
    },
};
</script>

<style scoped>
.toast-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    max-width: 400px;
}
</style>
