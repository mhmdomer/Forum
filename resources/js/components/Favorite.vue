<template>
    <div>
        <button :class="classes">
            <i class="fa fa-heart fa-5 shadow-lg" style="color:blue;"></i>
        </button>
    </div>
</template>

<script>
export default {

    props: ['reply'],
    data() {
        return {
            count: this.reply.favoriteCount,
            active: this.reply.isFavorited
        }
    },
    computed: {
        classes: function() {
            return this.isFavorited ? 'btn btn-default' : 'btn btn-default'
        }
    },

}
</script>