<template>
    <div v-if="visible" :class="[toastClass, isAppend]">
        <span>{{ message }}</span>
        <span v-if="!append" class="material-symbols-rounded close-btn" @click="close">
            close
        </span>
    </div>
</template>

<script>
export default {
    name: 'OneToast',
    props: {
        message: {
            type: String,
            required: true
        },
        theme: {
            type: String,
            default: 'success'
        },
        type: {
            type: String,
            default: 'info' // 'success', 'error', 'warning'
        },
        duration: {
            type: Number,
            default: 5000
        },
        append: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            visible: true
        }
    },
    computed: {
        toastClass() {
            switch (this.theme) {
                case 'success':
                    return 'text-success';
                case 'error':
                    return 'text-error';
                case 'warning':
                    return 'warning';
                default:
                    return 'info';
            }
        },
        isAppend() {
            console.log(this.append);
            return this.append ? 'toast-append' : 'one-toast';
        }
    },
    methods: {
        close() {
            this.visible = false;
        }
    },
    mounted() {
        setTimeout(() => {
            this.close();
        }, this.duration);
    }
}
</script>

<style scoped>
.one-toast {
    position: fixed;
    padding: 10px 40px 10px 20px;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
    display: flex;
    align-items: center;
    font-family: sans-serif;
}

.toast-append {
    padding: 10px 40px 10px 20px;
    z-index: 9999;
    max-width: 400px;
    display: flex;
    align-items: center;
    font-family: sans-serif;
}

.one-toast.success {
    background-color: #4caf50;
    /* green */
}

.one-toast.error {
    background-color: #f44336;
    /* red */
}

.one-toast.warning {
    background-color: #ff9800;
    /* orange */
    color: black;
}

.one-toast.info {
    background-color: #2196f3;
    /* blue */
}

.close-btn {
    padding: 0;
    background: none;
    border: none;
    font-size: 20px;
    font-weight: bold;
    color: inherit;
    cursor: pointer;
    position: absolute;
    top: 13px;
    right: 10px;
}
</style>
