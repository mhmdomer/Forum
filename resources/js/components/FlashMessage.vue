<template>
    <div class="message p-4 text-white rounded-lg z-50" :class="background" v-show="show">
        <span v-text="dat"></span>
    </div>
</template>

<script>
    export default {

        props : ['message', 'level'],
        data() {
            return {
                dat : '',
                show : false,
                background: false
            }
        },
        methods: {
            flash(message, level) {
                switch (level) {
                    case 'success':
                        this.background = 'bg-green-400'
                        break;
                    case 'alert':
                        this.background = 'bg-yellow-500'
                        break;
                    case 'danger':
                        this.background = 'bg-red-400'
                        break;
                    default:
                        this.background = 'bg-green-400'
                        break;
                }
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
                this.flash(this.message, this.level)
            }
            window.events.$on('flash', (message, level) => this.flash(message, level))
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
