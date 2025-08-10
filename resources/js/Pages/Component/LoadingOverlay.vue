<template>
    <div :class="loadingClass" v-if="isLoading">
        <span class="loader"></span>
    </div>

</template>

<script>
export default {
    name: 'LoadingOverlay',
    props: {
        isLoading: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        loadingClass() {
            return this.isLoading ? 'loading-overlay' : '';
        }
    },
}
</script>

<style scoped>
.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
