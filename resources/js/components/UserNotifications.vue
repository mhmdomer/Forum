<template>
    <li class="inline p-0 m-0" v-show="notifications.length">
        <a class="p-0 m-0" style="content: '';"><i class="fa fa-bell"></i></a>
        <ul class="nav-dropdown overflow-hidden">
            <li v-for="notification in notifications" :key="notification.id">
                <a
                :href="notification.data.link"
                v-text="notification.data.message"
                @click="markRead(notification)">
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    data() {
        return {
            notifications: false
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/profiles/' + App.user.name + '/notifications')
                .then(response => {
                    console.log(response.data)
                    this.notifications = response.data
                })
        },
        markRead(notification) {
            axios.delete('/profiles/' + App.user.name + '/notifications/' + notification.id)
                .then(response => {
                    console.log(response)
                })
        }
    },
}
</script>

<style scoped>

</style>
