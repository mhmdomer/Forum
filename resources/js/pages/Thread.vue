<script>
import Replies from '../components/Replies.vue';
import SubscribeButton from '../components/SubscribeButton.vue';
import LockButton from '../components/LockButton.vue';
import Favorite from '../components/Favorite.vue';
export default {
    name: "thread-view",
    props: ['thread'],
    components: { Replies, SubscribeButton, LockButton, Favorite },
    data() {
        return {
            repliesCount: this.thread.replies_count,
            favorited: this.thread.isFavorited,
            count: this.thread.favorites_count,
            id: this.thread.id,
            editing: false,
            form: {
                title: this.thread.title,
                body: this.thread.body
            },
            title: this.thread.title,
            body: this.thread.body,
            uri: '/threads/' + this.thread.channel.slug + '/' + this.thread.slug,
        }
    },
    methods: {
        save() {
            axios.patch(this.uri, this.form)
                .then(respone => {
                    flash('Updated Successfully')
                    this.editing = false
                    this.title = this.form.title
                    this.body = this.form.body
                })
                .catch(error => {
                    console.log(error.response)
                    flash(error.response.data.message, 'danger')
                })
        },
        cancel() {
            this.editing = false
            this.form.title = this.title
            this.form.body = this.body
        },
        remove() {
            axios.delete(this.uri)
                .then(response => {
                    flash('Thread Deleted')
                })
                .catch(error => {
                    flash(error.response.data.message, 'danger')
                })
        },
        toggleFavorite() {
            if(!this.favorited) {
                this.favorited = true
                this.count++
            } else {
                this.favorited = false
                this.count--

            }
        }
    },
}
</script>
