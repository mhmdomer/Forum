<template>
<div>
    <div v-if="signedIn">
        <div class="mb-4">
            <wysiwyg v-model="body" name="body" :shouldClear="clear"></wysiwyg>
        </div>
        <div class="mb-4">
            <button class="button" @click="add" :disabled="disabled">Post</button>
        </div>
    </div>
    <div class="pt-4" v-else>
        <p class="text-center">Please <a href="/login" class="text-indigo-700">sign in</a> to participate on Threads</p>
    </div>
</div>
</template>

<script>
import AtTa from 'vue-at/dist/vue-at-textarea'
import mentions from '../mixins/mentions'

export default {
    name: "add-reply",
    components: { AtTa },
    mixins: [ mentions ],
    data() {
        return {
            body: '',
            disabled: false,
            clear: false,
        }
    },
    computed: {
        signedIn() {
            return window.App.signedIn == true
        }
    },
    methods: {
        add() {
            this.disabled = true
            axios.post(location.pathname + '/replies', {
                    body: this.body
                })
                .then(response => {
                    this.body = ''
                    this.clear = ! this.clear
                    this.$emit('added', response.data)
                    this.disabled = false
                })
                .catch(error => {
                    this.disabled = false
                    flash(error.response.data.message, 'danger')
                })
        }
    },
}
</script>
