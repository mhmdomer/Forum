<template>
    <div>
        <button :class="classes" @click="toggle" :disabled="disabled" v-text="message"></button>
    </div>
</template>

<script>
export default {
    props: ['thread'],
    data() {
        return {
            disabled: false,
            locked: this.thread.locked,
        }
    },
    computed: {
        classes() {
            return ['button', this.locked ? 'bg-green-200 text-green-800 hover:bg-green-300' : 'bg-red-300 text-red-800 hover:bg-red-400']
        },
        message() {
            return this.locked ? 'Unlcok' : 'Lock'
        }
    },
    methods: {
        toggle() {
            this.disabled = true
            let uri = '/threads/' + this.thread.slug + '/' + (this.locked ? 'unlock' : 'lock')
            console.log(uri)
            axios.post(uri)
                .then(response => {
                    this.disabled = false
                    window.events.$emit('lockchanged', this.locked)
                })
                .catch(error => {
                    this.locked = !this.locked
                    this.disabled = false
                })
            this.locked = !this.locked

        }
    },
}
</script>
