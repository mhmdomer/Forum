<template>
<div>
    <div v-for="(reply, index) in items" :key="reply.id">
        <reply :data="reply" @deleted="remove(index)" class="mb-4"></reply>
    </div>
    <add-reply :endpoint="endpoint" @added="add"></add-reply>

</div>
</template>

<script>
import Reply from './Reply';
import AddReply from './AddReply'
import collection from '../mixins/collection'
export default {
    name: "replies",
    mixins: [collection],
    components: { Reply, AddReply },
    data() {
        return {
            dataSet: false,
        }
    },
    computed: {
        endpoint() {
            return location.pathname + '/replies'
        },
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get(this.endpoint)
                .then(response => {
                    this.dataSet = response.data
                    this.items = response.data.data
                })
        },
    },
}
</script>
