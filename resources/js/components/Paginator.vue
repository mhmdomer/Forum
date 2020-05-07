<template>
<div class="pagination mx-auto" v-show="shouldPaginate">
    <a href="#" disabled @click.prevent="page--" v-if="prevUrl != null" class="bg-indigo-600 hover:bg-indogo-700">
        &laquo; Previous
    </a>

    <a href="#" @click.prevent="page++" v-if="nextUrl != null" class="bg-indigo-600 hover:bg-indogo-700">
        Next &raquo;
    </a>
</div>
</template>

<script>
export default {
    props: ['dataSet'],
    data() {
        return {
            page: 1,
            nextUrl: false,
            prevUrl: false,
            requested: false
        }
    },
    watch: {
        dataSet() {
            this.requested = false
            this.page = this.dataSet.current_page
            this.nextUrl = this.dataSet.next_page_url
            this.prevUrl = this.dataSet.prev_page_url
        },
        page() {
            if(!this.requested){
                this.$emit('changed', this.page)
            }
            this.requested = true
            // update the url
            history.pushState(null, null, '?page='+this.page)
        }
    },
    computed: {
        shouldPaginate() {
            return !!this.nextUrl || !!this.prevUrl // !! for assuring that we get a boolean result
        },
    },
}
</script>


<style>
.pagination {
    display: inline-block;
}

.pagination a {
    color: gainsboro;
    float: left;
    padding: 5px 12px;
    text-decoration: none;
    border: 1px solid #ddd;
}

.pagination a.active {
    color: white;
    border: 1px solid #4CAF50;
}

.pagination a:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

.pagination a:last-child {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
</style>
