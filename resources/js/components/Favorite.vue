<template>
    <div>
        <button class="md:ml-10 px-1 rounded-full text-sm" :class="classes" @click="toggleFavorite" :disabled="!auth">
            <span v-text="likes" class="text-xs"></span> <i class="fa fa-heart fa-5 shadow-lg"></i>
        </button>
    </div>
</template>

<script>
export default {

    props: ['reply', 'auth'],
    data() {
        return {
            count: this.reply.favoriteCount,
            isFavorited: this.reply.isFavorited
        }
    },
    computed: {
        classes() {
            var classes =  this.isFavorited ? 'text-red-500 bg-red-200' : 'text-gray-700 bg-gray-300'
            classes +=  ' ' + this.auth ? '' : 'cursor-default'
            return classes
        },
        endpoint() {
            return '/replies/' + this.reply.id + '/favorites'
        },
        likes() {
            return this.format_number(this.count)
        }
    },

    methods: {
        toggleFavorite() {
            this.isFavorited ? this.unFavorite() : this.favorite()
        },
        favorite() {
            axios.post(this.endpoint)
            this.isFavorited = true
            this.count++
        },
        unFavorite() {
            axios.delete(this.endpoint)
            this.isFavorited = false
            this.count--
        },
        format_number(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
    },

}
</script>
