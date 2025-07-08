<script>
import { ref } from 'vue'
import { route } from 'ziggy-js'
import apiClient from '../axios'

export default {
    layout: null,
    methods: {
        async handleLogin() {
            try {
                await apiClient.get('/sanctum/csrf-cookie');
                const response =  await apiClient.post(route('user.login'), {
                    email: this.email,
                    password: this.password,
                });
                if (response.data.success && response.data.role === 'Admin') {
                    this.$inertia.visit(route('project'));
                } else if (response.data.success && response.data.role === 'Member') {
                    this.$inertia.visit(route('task')); //project.show
                } else {
                    this.errorMessage = response.data.message || 'Login failed. Please try again.';
                }
            } catch (error) {
                console.error('Logout failed:', error);
            }
        }
    }
}
</script>

<template>
    <div class="login">
        <div class="container" id="container">
            <div class="form-container sign-in-container">
                <form @submit.prevent="handleLogin">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <h1>Login</h1>
                    <div v-if="errorMessage" class="error-message" style="color: red;">
                        {{ errorMessage }}
                    </div>
                    <input v-model="email" type="email" name="email" placeholder="Email" />
                    <input v-model="password" type="password" name="password" placeholder="Password" />
                    <button type="submit">Login</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                    </div>
                </div>
            </div>
            <!-- <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
    box-sizing: border-box;
}

.login {
    /* background: #f6f5f7; */
    /* background-image: url(https://img.freepik.com/free-photo/top-view-person-writing-laptop-with-copy-space_23-2148708035.jpg?ga=GA1.1.1450914104.1747831543&semt=ais_hybrid&w=740); */
    background-size: cover;
    background-image: url(https://img.freepik.com/free-photo/flat-lay-photo-office-desk-with-laptop-copy-space-background_1150-45598.jpg?ga=GA1.1.1450914104.1747831543&w=740);
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
    height: 100vh;
}

h1 {
    font-weight: bold;
    margin: 0;
}

h2 {
    text-align: center;
}

p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    letter-spacing: 0.5px;
    margin: 20px 0 30px;
}

span {
    font-size: 12px;
}

a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
}

form button {
    border-radius: 20px;
    border: 1px solid #2b75ff;
    background-color: #2b75ff;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
}

button:active {
    transform: scale(0.95);
}

button:focus {
    outline: none;
}

button.ghost {
    background-color: transparent;
    border-color: #FFFFFF;
}

.form-container form {
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    width: unset;
    text-align: center;
}

input {
    background-color: #eee;
    border: none;
    padding: 12px 15px;
    width: 100%;
}

.container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
        0 10px 10px rgba(0, 0, 0, 0.22);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in-container {
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.right-panel-active .sign-in-container {
    transform: translateX(100%);
}

.sign-up-container {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: show 0.6s;
}

@keyframes show {

    0%,
    49.99% {
        opacity: 0;
        z-index: 1;
    }

    50%,
    100% {
        opacity: 1;
        z-index: 5;
    }
}

.overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 100;
}

.container.right-panel-active .overlay-container {
    transform: translateX(-100%);
}

.overlay {
    background-image: url(https://img.freepik.com/free-photo/businesswoman-using-laptop-presenting-project-report-business-meeting-closeup_1163-4763.jpg?ga=GA1.1.1450914104.1747831543&semt=ais_hybrid&w=740);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 0 0;
    color: #ffffff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
    transform: translateX(50%);
}

.overlay-panel {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    text-align: center;
    top: 0;
    height: 100%;
    width: 50%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
    background: -webkit-linear-gradient(to right, #181818de, #dedede00);
    background: linear-gradient(to right, #181818de, #dedede00);
}

.overlay-left {
    transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
    transform: translateX(0);
}

.overlay-right {
    right: 0;
    transform: translateX(0);
}

.container.right-panel-active .overlay-right {
    transform: translateX(20%);
}

.social-container {
    margin: 20px 0;
}

.social-container a {
    border: 1px solid #DDDDDD;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    height: 40px;
    width: 40px;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}
</style>
