<template>
    <div class="d-flex-row-container page-header card top-panel">
        <div class="d-flex-row-container">
           <slot />
           <slot />
           <slot />
        </div>
        <div class="d-flex-row-container">
            <button class="btn btn-no-bg notification-btn" title="Notifications">
                <span class="material-symbols-rounded">&#xe7f4;</span>
            </button>
            <button class="btn btn-no-bg mail-btn" title="Mail">
                <span class="material-symbols-rounded">&#xe158;</span>
            </button>
            <!-- <button class="theme-toggle btn-no-bg" @click="toggleTheme">
                <span class="material-symbols-rounded" id="moonIcon" v-show="theme === 'dark'">&#xe518;</span>
                <span class="material-symbols-rounded" id="sunIcon" v-show="theme === 'light'">&#xe51c;</span>
            </button> -->
        </div>
    </div>

</template>

<script>
export default {
    props: {

    },
    data() {
        return {

        }
    }
}
</script>
