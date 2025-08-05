<template>
    <div v-if="visible" class="one-toast" :class="toastClass">
        <span>{{ message }}</span>
        <button class="close-btn" @click="close">×</button>
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
        type: {
            type: String,
            default: 'info' // 'success', 'error', 'warning'
        },
        duration: {
            type: Number,
            default: 3000
        }
    },
    data() {
        return {
            visible: true
        }
    },
    computed: {
        toastClass() {
            switch (this.type) {
                case 'success':
                    return 'success';
                case 'error':
                    return 'error';
                case 'warning':
                    return 'warning';
                default:
                    return 'info';
            }
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
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    padding: 12px 16px;
    border-radius: 6px;
    color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    max-width: 300px;
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
    margin-left: 12px;
    background: none;
    border: none;
    font-size: 20px;
    font-weight: bold;
    color: inherit;
    cursor: pointer;
}
</style>
