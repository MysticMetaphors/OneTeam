<template>
    <div v-if="visible" class="one-toast text-success"><!--:class="toastClass" -->
        <span>{{ message }}</span>
        <span class="material-symbols-rounded close-btn" @click="close">
            close
        </span>
        <!-- <button >×</button> -->
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
        // setTimeout(() => {
        //     this.close();
        // }, this.duration);
    }
}
</script>

<style scoped>
.one-toast {
    position: fixed;
    /* padding-right: 40px; */
    padding: 10px 40px 10px 20px;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); */
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
