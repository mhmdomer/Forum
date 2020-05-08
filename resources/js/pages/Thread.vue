<script>
import Replies from '../components/Replies.vue';
import SubscribeButton from '../components/SubscribeButton.vue';
export default {
    name: "thread-view",
    props: ['initialCount'],
    components: { Replies, SubscribeButton },
    data() {
        return {
            repliesCount: this.initialCount,
        }
    },
}
</script>
