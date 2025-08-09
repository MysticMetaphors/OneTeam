<template>
    <div class="main-content">
        <one-top-bar page="Task/Create">
            <div class="d-flex-row-container">
                <button type="button" @click="cancel" class="btn btn-sm btn-outline-secondary btn-no-bg">
                    <span class="material-symbols-rounded">arrow_back</span>
                    Back
                </button>
            </div>
        </one-top-bar>

        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <h2>New User</h2>
            <OneToast v-if="message" :message="message" />
            <div class="toast-container">
                <OneToast v-for="(msg, index) in errors[0]" :key="index" :message="msg[0]" theme="error"
                    :append="true" />
            </div>

            <div class="form-direction-row">
                <input type="text" name="name" placeholder="Name" :class="{ 'input-error': errors.name }"
                    v-model="form.name" />
                <input type="text" name="email" placeholder="Email" :class="{ 'input-error': errors.email }"
                    v-model="form.email" />
            </div>

            <div class="form-direction-row input-icon" :class="{ 'input-error': errors.image }">
                <input type="file" name="image" @change="onFileChange" />
                <span class="material-symbols-rounded">add_a_photo</span>
            </div>

            <div class="form-direction-row">
                <input type="text" name="contact" placeholder="Contact" :class="{ 'input-error': errors.contact }"
                    v-model="form.contact" />
                <input type="text" name="location" placeholder="Location" :class="{ 'input-error': errors.location }"
                    v-model="form.location" />
            </div>

            <div class="form-direction-row input-icon">
                <label for="birthdate">Birth</label>
                <input type="date" id="birthdate" name="birthdate" :class="{ 'input-error': errors.birthdate }"
                    v-model="form.birthdate" />
            </div>

            <div class="form-direction-row">
                <div class="form-direction-row input-icon" :class="{ 'input-error': errors.position }">
                    <input type="text" name="position" placeholder="Position" v-model="form.position" />
                    <span class="material-symbols-rounded"></span>
                </div>
                <div class="form-direction-row input-icon" :class="{ 'input-error': errors.role }">
                    <select name="role" v-model="form.role">
                        <option hidden value="">Select role</option>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                    <span class="material-symbols-rounded">expand_more</span>
                </div>
            </div>

            <div class="form-direction-row">
                <div class="form-direction-row input-icon" :class="{ 'input-error': errors.password }">
                    <input type="password" name="password" placeholder="Password" v-model="form.password" />
                    <span class="material-symbols-rounded"></span>
                </div>

                <div class="form-direction-row input-icon" :class="{ 'input-error': errors.repeatPassword }">
                    <input type="password" name="repeat-password" placeholder="Repeat Password"
                        v-model="form.repeatPassword" />
                    <span class="material-symbols-rounded">visibility</span>
                </div>
            </div>

            <div class="form-direction-row">
                <!-- <button type="button" @click="cancel">
                    Cancel
                </button> -->
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
import OneTopBar from '../Component/OneTopBar.vue';
import OneToast from '../Component/OneToast.vue';

export default {
    name: "UserCreate",
    components: {
        OneTopBar,
        OneToast
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                image: null,
                contact: "",
                location: "",
                birthdate: "",
                position: "",
                role: "",
                password: "",
                repeatPassword: "",
            },
            errors: [],
            message: "",
            passwordError: "",
        };
    },
    methods: {
        onFileChange(e) {
            this.form.image = e.target.files[0];
        },
        cancel() {
            this.$inertia.visit(route('user'))
        },
        async submitForm() {
            try {
                await apiClient.get('/sanctum/csrf-cookie');
                if (this.form.password !== this.form.repeatPassword) {
                    this.errors.repeatPassword = true;
                    this.passwordError = "Passwords do not match";
                }
                const form = Object.entries(this.form);
                const formData = new FormData()
                for (let i = 0; i < form.length; i++) {
                    const [key, value] = form[i];
                    formData.append(key, value)
                }
                const response = await apiClient.post(route('user.store'), formData)
                this.message = response.data.message;
                this.$inertia.visit(route('user.create'))
            } catch (errors) {
                console.log('Error: ', errors)
                this.errors.push(errors.response.data.errors);
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
