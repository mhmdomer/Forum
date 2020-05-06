<template>
    <div>
        <button class="px-1 rounded-full text-sm" :class="classes" @click="toggleFavorite">
            <span v-text="count" class="text-xs"></span> <i class="fa fa-heart fa-5 shadow-lg"></i>
        </button>
    </div>
</template>

<script>
export default {

    props: ['reply'],
    data() {
        return {
            count: this.reply.favoriteCount,
            isFavorited: this.reply.isFavorited
        }
    },
    computed: {
        classes() {
            return this.isFavorited ? 'text-red-500 bg-red-200' : 'text-gray-700 bg-gray-300'
        },
        endpoint() {
            return '/replies/' + this.reply.id + '/favorites'
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
    },

}
</script>
