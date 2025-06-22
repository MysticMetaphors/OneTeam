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
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <h2>New User</h2>
            <div v-if="message" class="text-success">{{ message }}</div>
            <div v-if="passwordError" class="text-error">{{ passwordError }}</div>

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
import apiClient from '../../axios';

export default {
    name: "UserCreate",
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
            errors: {},
            message: "",
            passwordError: "",
        };
    },
    methods: {
        onFileChange(e) {
            this.form.image = e.target.files[0];
        },
        cancel() {
            this.$inertia.visit('user')
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
                console.log(formData)
                const response = await apiClient.post(route('user.store'), formData)
                this.message = response.data.message;
                // this.$inertia.visit('user.create')
            } catch (errors) {
                console.log('Error: ', errors)
            }
        },
    },
};
</script>
