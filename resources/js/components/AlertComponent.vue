<template>
    <div class="message p-4 text-white rounded-lg" :class="background" v-show="show">
        <span v-text="dat"></span>
    </div>
</template>

<script>
    export default {

        props : ['message', 'color'],
        data() {
            return {
                dat : '',
                show : false,
                background : 'bg-green-400'
            }
        },
        methods: {
            flash(message, color) {
                console.log(color)
                this.dat = message
                this.background = color
                this.show = true
                this.hide()
            },
            hide() {
                setTimeout(() => {
                    this.show = false
                }, 3000);
            }
        },
        created() {
            if(this.message) {
                this.flash(this.message, this.color ? this.color : 'bg-green-400')
            }
            window.events.$on('flash', (message, color) => this.flash(message, color))
        }

    }
</script>

<style>
    .message {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }
    /* .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    } */
</style>
