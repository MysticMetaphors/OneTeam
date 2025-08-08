<template>
    <div class="main-content">
        <one-top-bar page="Activity">
        </one-top-bar>

        <div class="act-content contents">
            <div class="table-container" id="act-table-view">
                <table class="table table-striped acts-table table-responsive">
                    <thead></thead>
                    <tbody>
                        <tr v-for="act in filteredActivities" :key="act.id">
                            <td>{{ act.title }}</td>
                            <td>
                                <div v-if="getUser(act.made_by)" class="profile">
                                    <img :src="profileImage(getUser(act.made_by))" class="profile-img"
                                        style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                    {{ getUser(act.made_by).name }}
                                </div>
                                <span v-else>—</span>
                            </td>
                            <td>
                                <div class="tags" :class="act.type === 'Project' ? 'tag-success' : 'tag-primary'">
                                    {{ act.type }}
                                </div>
                            </td>
                            <td>
                                <div class="tags" :class="{
                                    'tag-success': act.action === 'Create',
                                    'tag-warning': act.action === 'Update',
                                    'tag-danger': act.action === 'Destroy',
                                    'tag-primary': !['Create', 'Update', 'Destroy'].includes(act.action)
                                }">
                                    {{ act.action }}
                                </div>
                            </td>
                            <td>
                                <span v-if="act.created_at" class="convertDate">
                                    {{ formatDate(act.created_at) }}
                                </span>
                                <span v-else>—</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from './layout/MainLayout.vue'
import OneTopBar from './Component/OneTopBar.vue'

export default {
    layout: MainLayout,
    components: {
        OneTopBar
    },
    props: {
        activity: Object,
        users: Object,
    },
    data() {
        return {
            search: '',
            isDark: false
        }
    },
    // mounted() {
    //     const actArr = Object.a
    // }
    // ,
    computed: {
        filteredActivities() {
            if (!this.search) return this.activity
            return this.activity.filter(act =>
                act.title?.toLowerCase().includes(this.search.toLowerCase()) ||
                this.getUser(act.made_by)?.name?.toLowerCase().includes(this.search.toLowerCase()) ||
                act.type?.toLowerCase().includes(this.search.toLowerCase()) ||
                act.action?.toLowerCase().includes(this.search.toLowerCase())
            )
        }
    },
    methods: {
        getUser(id) {
            return this.users.find(u => u.id === id)
        },
        profileImage(user) {
            return user && user.image ? `storage/profile/${user.image}` : ''
        },
        formatDate(dateStr) {
            const date = new Date(dateStr)
            return date.toLocaleString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                // hour: 'numeric',
                // minute: '2-digit'
            })
        },
        onSearch() {
            // Optionally handle search logic here
        }
    }
}
</script>

<style scoped>
/* .contents {
    padding: 70px 0 0 0;
} */

.profile {
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>
