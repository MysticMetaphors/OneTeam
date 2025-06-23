<template>
    <button :class="bg ? 'btn-no-bg' : ''" @click="is_link ? goToLink() : toggleIcon()">
        <span class="material-symbols-rounded" v-show="toggled">{{ icon }}</span>
        <span v-if="secondary_icon" class="material-symbols-rounded" v-show="!toggled">{{ secondary_icon }}</span>
        {{ text }}
    </button>
</template>

<script>
export default {
    props: {
        text: String,
        icon: String,
        secondary_icon: String,
        link: String,
        bg: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            toggled: true,
            is_link: this.link ? true : false
        }
    },
    methods: {
        toggleIcon() {
            console.log('icon')
            if (this.secondary_icon) {
                this.toggled = !this.toggled
            }
        },
        goToLink() {
            console.log('link')
            this.$inertia.visit(this.link)
        },
    },
}
</script>
