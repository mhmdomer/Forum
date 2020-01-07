<template>
    <div class="alert alert-success message fade-enter-active fade-leave-active" v-show="show">
        <strong>Success</strong> <span v-text="dat"></span>
    </div>
</template>

<script>
    export default {

        props : ['message'],
        data() {
            return {
                dat : '',
                show : false
            }
        },
        methods: {
            flash(message) {
                this.dat = message
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
                this.flash(this.message)
            }
            window.events.$on('flash', message => this.flash(message))
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