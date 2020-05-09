<template>
    <div>
        <div v-if="signedIn">
            <div class="mb-4">
                <textarea type="date" rows="4" class="input-field bg-gray-300" name="body" placeholder="Have something to say ?" v-model="body"></textarea>
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
export default {
    name: "add-reply",
    data() {
        return {
            body: '',
            disabled: false,
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
            axios.post(location.pathname + '/replies', {body: this.body})
                .then(response => {
                    this.body = ''
                    this.$emit('added', response.data)
                    this.disabled = false
                })
                .catch(error => {
                    this.body = ''
                    this.disabled = false
                    flash('An error accured while saving the reply', 'bg-red-500')
                    console.log(error)
                })
        }
    },
}
</script>
