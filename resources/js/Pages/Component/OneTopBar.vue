<template>
    <div class="d-flex-row-container page-header card top-panel">
        {{ page }}
        <div class="d-flex-row-container">
            <slot />
            <button class="btn btn-no-bg notification-btn" title="Notifications">
                <span class="material-symbols-rounded">&#xe7f4;</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        page: {
            type: String,
            required: true,
        },
    },
    data() {
        return {

        }
    }
}
</script>
