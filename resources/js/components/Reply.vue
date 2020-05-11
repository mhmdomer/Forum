<template>
<div :id="'reply-'+id" class="bg-white p-4 rounded">
    <div class="text-gray-800 text-lg">
        <div class="flex items-center">
            <div>
                <img :src="'/images/avatar' + 1 +'.jpg'" class="inline w-12 h-12 mr-4 rounded-full" alt="avatar" />
                <a class :href="'/profiles/'+reply.user.name" v-text="reply.user.name"></a>
                <span class="inline-block text-sm mt-0 text-gray-600" v-text="ago"></span>
            </div>
            <div class="ml-auto" v-if="!editing && signedIn && authorized">
                <button @click="editing = true" class="inline mr-1 rounded bg-gray-600 text-sm text-white px-2">
                    <i class="fa fa-pencil"></i>
                </button>
                <button class="inline rounded bg-red-500 text-sm text-white px-2" @click="remove">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
    <div>
        <div v-if="!editing">
            <p class="text-gray-700 md:ml-10 bg-gray-100 rounded-lg p-4" v-html="reply.body"></p>
            <favorite :reply="this.reply" class="mt-2"></favorite>
        </div>
        <div v-else class>
            <div class="md:ml-10 mt-2">
                <at-ta :members="mentions">
                    <textarea @keyup="changing(reply.body)" class="input-field bg-gray-300 focus:bg-gray-200" v-model="reply.body"></textarea>
                </at-ta>
            </div>
            <div class="md:ml-10 mt-2">
                <button @click="editing = false" class="rounded bg-gray-600 text-white px-3">Cancel</button>
                <button style="display:inline" class="rounded bg-green-500 text-white px-3" @click="save">Save</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import AtTa from 'vue-at/dist/vue-at-textarea'
import mentions from '../mixins/mentions'
import Favorite from "./Favorite.vue";
import moment from 'moment'
export default {
    name: "reply",
    props: ["data"],
    mixins: [ mentions ],
    components: {
        Favorite,
        AtTa
    },
    data() {
        return {
            reply: this.data,
            id: this.data.id,
            editing: false,
            signedIn: window.App.signedIn,
            validBody: this.data.body,
        };
    },
    computed: {
        authorized() {
            return this.authorize((user) => user.id == this.reply.user.id)
        },
        ago() {
            return moment(this.reply.created_at).fromNow()
        }
    },
    methods: {
        save() {
            axios.patch("/replies/" + this.id, {
                    body: this.reply.body
                })
                .then(response => {
                    this.validBody = this.reply.body
                    flash('Reply Saved')
                })
                .catch(error => {
                    this.reply.body = this.validBody
                    flash(error.response.data.message, 'danger')
                });
            this.editing = false
        },
        remove() {
            axios.delete("/replies/" + this.id);
            this.$emit('deleted')
        },
    },

}
</script>

<style>
</style>
