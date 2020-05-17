<template>
    <div>
        <button class="px-1 rounded-full text-sm" :class="classes" @click="toggleFavorite" :disabled="!authorized || isDisabled">
            <span v-text="likes" class="text-xs"></span> <i class="fa fa-heart fa-5 shadow-lg"></i>
        </button>
    </div>
</template>

<script>
export default {

    props: ['model', 'endpoint'],
    data() {
        return {
            count: this.model.favoriteCount,
            isFavorited: this.model.isFavorited,
            authorized: window.App.signedIn,
            isDisabled: false,
        }
    },
    computed: {
        classes() {
            var classes =  this.isFavorited ? 'text-red-500 bg-red-200' : 'text-gray-700 bg-gray-300'
            classes +=  ' ' + this.auth ? '' : 'cursor-default'
            return classes
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
            this.isDisabled = true
            axios.post(this.endpoint)
                .then(response => {
                    this.isDisabled = false
                })
                .catch(error => {
                    this.isDisabled = false
                    this.isFavorited = ! this.isFavorited
                    this.count--
                })
            this.isFavorited = true
            this.count++
        },
        unFavorite() {
            this.isDisabled = true
            axios.delete(this.endpoint)
                .then(response => {
                    this.isDisabled = false
                })
                .catch(error => {
                    this.isDisabled = false
                    this.isFavorited = ! this.isFavorited
                    this.count++
                })
            this.isFavorited = false
            this.count--
        },
        format_number(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
    },

}
</script>
