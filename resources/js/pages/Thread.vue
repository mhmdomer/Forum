<script>
import Replies from '../components/Replies.vue';
export default {
    name: "thread-view",
    props: ['initialCount'],
    components: { Replies },
    data() {
        return {
            repliesCount: this.initialCount,
        }
    },
}
</script>
