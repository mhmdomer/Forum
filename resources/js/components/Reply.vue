<template>
<div :id="'reply-'+id" class="bg-white p-4 rounded" :class="isBest ? 'bg-green-200' : ''">
    <div class="text-gray-800 text-lg">
        <div class="flex items-center">
            <div>
                <img :src="reply.user.image" class="inline w-12 h-12 mr-4 rounded-full" alt="avatar" />
                <a class :href="'/profiles/'+reply.user.name" v-text="reply.user.name"></a>
                <span class="inline-block text-sm mt-0 text-gray-600" v-text="ago"></span>
            </div>
            <div class="ml-auto" v-if="!editing && signedIn && authorize('owns', reply)">
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
            <div class="flex">
                <favorite :reply="this.reply" class="mt-2"></favorite>
                <button v-show="!isBest && authorize('owns', reply.thread)" class="ml-auto button text-sm px-1 py-0" @click="markBest">Mark as Best</button>
            </div>
        </div>
        <div v-else class>
            <div class="md:ml-10 mt-2">
                <at-ta :members="mentions">
                    <textarea @keyup="changing(reply.body)" class="input-field bg-gray-300 focus:bg-gray-200" v-model="reply.body"></textarea>
                </at-ta>
            </div>
            <div class="md:ml-10 mt-2">
                <button @click="cancel" class="rounded bg-gray-600 text-white px-3">Cancel</button>
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
            validBody: this.data.body,
            isBest: this.data.isBest,
        };
    },
    created() {
        window.events.$on('bested', id => {
            this.isBest = (id == this.id)
        })
    },
    computed: {
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
        cancel() {
            this.editing = false
            this.reply.body = this.validBody
        },
        markBest() {
            axios.post("/replies/" + this.reply.id + "/best")
                .then(response => {
                    flash('Best reply recorded')
                })
                .catch(error => {
                    flash(error.response.data.message, 'danger')
                })
            window.events.$emit('bested', this.reply.id)
        }
    },

}
</script>

<style>
</style>
