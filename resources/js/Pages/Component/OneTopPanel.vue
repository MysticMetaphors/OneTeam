<template>
    <div class="d-flex-row-container page-header card top-panel">
        <div class="d-flex-row-container">
            Projects/All
        </div>
        <div class="d-flex-row-container">
            <div class="d-flex-row-container">
                <slot />
                <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                    @click="goToCreateProject">
                    <span class="material-symbols-rounded">add</span>
                    New project
                </button>
            </div>
            <button class="btn btn-sm btn-outline-secondary btn-no-bg" id="bulkCompleteBtn" title="Add Selected"
                @click="goToCreateProject">
                <span class="material-symbols-rounded">add</span>
                New project
            </button>
            <!-- <button class="btn btn-no-bg notification-btn" title="Notifications">
                <span class="material-symbols-rounded">&#xe7f4;</span>
            </button>
            <button class="btn btn-no-bg mail-btn" title="Mail">
                <span class="material-symbols-rounded">&#xe158;</span>
            </button>
            <button class="theme-toggle btn-no-bg">
                <span class="material-symbols-rounded" id="moonIcon" style="display: none;">&#xe518;</span>
                <span class="material-symbols-rounded" id="sunIcon">&#xe51c; </span>
            </button> -->
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: Object
    },
    data() {
        return {

        }
    }
}
</script>
