<script>
import Replies from '../components/Replies.vue';
import SubscribeButton from '../components/SubscribeButton.vue';
import LockButton from '../components/LockButton.vue';
export default {
    name: "thread-view",
    props: ['initialCount'],
    components: { Replies, SubscribeButton, LockButton },
    data() {
        return {
            repliesCount: this.initialCount,
        }
    },
}
</script>
