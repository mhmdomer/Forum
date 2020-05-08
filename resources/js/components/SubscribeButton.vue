<template>
    <div>
        <button :class="classes" @click="toggle" :disabled="disabled" v-text="message"></button>
    </div>
</template>

<script>
export default {
    props: ['active'],
    data() {
        return {
            disabled: false,
            subscribed: this.active,
        }
    },
    computed: {
        classes() {
            return ['button', !this.subscribed ? 'bg-gray-200 text-gray-800 hover:bg-gray-300' : '']
        },
        message() {
            return this.subscribed ? 'Subscribed !' : 'Subscribe'
        }
    },
    methods: {
        toggle() {
            this.disabled = true
            axios[this.subscribed ? 'delete' : 'post'](location.pathname + '/subscriptions')
                .then(response => {
                    this.disabled = false
                })
                .catch(error => {
                    this.subscribed = !this.subscribed
                    this.disabled = false
                })
            this.subscribed = !this.subscribed

        }
    },
}
</script>