<template>
<div>
    <div v-for="(reply, index) in replies" :key="reply.id">
        <reply :data="reply" @deleted="remove(index)" class="mb-4"></reply>
    </div>
    <add-reply :endpoint="endpoint" @added="add"></add-reply>

</div>
</template>

<script>
import Reply from './Reply';
import AddReply from './AddReply'
export default {
    name: "replies",
    components: { Reply, AddReply },
    props: ['data'],
    data() {
        return {
            replies: this.data
        }
    },
    computed: {
        endpoint() {
            return location.pathname + '/replies'
        }
    },
    methods: {
        add(reply) {
            console.log(reply)
            this.replies.push(reply)
            this.$emit('added')
        },
        remove(index) {
            this.replies.splice(index, 1)
            this.$emit('deleted')
        }
    },
}
</script>
