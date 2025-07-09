<template>
    <div class="main-content">
        <div class="d-flex-row-container page-header card top-panel">
            <div class="d-flex-row-container">
                <button class="btn-no-bg" title="Team View">
                    <span class="material-symbols-rounded">group</span>
                    Team
                </button>
                <button class="btn-no-bg btn-border" title="Task Table View">
                    <span class="material-symbols-rounded">checklist</span>
                    View Task
                </button>
            </div>
            <div class="d-flex-row-container">
                <button class="btn btn-no-bg notification-btn" title="Notifications">
                    <span class="material-symbols-rounded">&#xe7f4;</span>
                </button>
                <button class="btn btn-no-bg mail-btn" title="Mail">
                    <span class="material-symbols-rounded">&#xe158;</span>
                </button>
                <button class="theme-toggle btn-no-bg">
                    <span class="material-symbols-rounded" v-show="!isDark">&#xe51c;</span>
                    <span class="material-symbols-rounded" v-show="isDark">&#xe518;</span>
                </button>
            </div>
        </div>

        <div class="act-content contents">
            <div class="table-container" id="act-table-view">
                <table class="table table-striped acts-table table-responsive">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex-row-container" style="gap: 12px;">
                                    <div class="d-flex-row-container">
                                        Activity
                                    </div>
                                    <div class="d-flex-row-container">
                                        <!-- <div class="search-bar">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                v-model="search" @input="onSearch">
                                            <button class="btn search-btn" type="submit" title="Search"
                                                @click="onSearch">
                                                <span class="material-symbols-rounded">&#xe8b6;</span>
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
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

export default {
    layout: MainLayout,
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
.contents {
    padding: 70px 0 0 0;
}

.profile {
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>
