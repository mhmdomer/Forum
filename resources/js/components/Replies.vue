<template>
<div>
    <div v-for="(reply, index) in items" :key="reply.id">
        <reply :data="reply" @deleted="remove(index)" class="mb-4"></reply>
    </div>
    <paginator :dataSet="dataSet" @changed="getData"></paginator>
    <add-reply @added="add"></add-reply>

</div>
</template>

<script>
import Reply from './Reply';
import AddReply from './AddReply'
import collection from '../mixins/collection'
import Paginator from './Paginator'
export default {
    name: "replies",
    mixins: [ collection ],
    components: { Reply, AddReply, Paginator },
    data() {
        return {
            dataSet: false,
        }
    },
    created() {
        this.getData()
    },
    methods: {
        endpoint(page) {
            if (!page) {
                // grap the page number from the url in case someone wrote the url directly
                let search = location.search.match(/page=(\d+)/)
                page = search ? search[1] : 1
            }
            return location.pathname + '/replies' + '?page=' + page
        },
        getData(page) {
            axios.get(this.endpoint(page))
                .then(response => {
                    this.dataSet = response.data
                    this.items = response.data.data
                })
        },
    },
}
</script>
