<script>
import RepliesComponent from "../components/RepliesComponent.vue";
import SubscribeButton from "../components/SubscribeButton.vue";

export default {
  props: ["initialRepliesCount"],

  components: { RepliesComponent, SubscribeButton },
  data() {
    return {
      repliesCount: this.initialRepliesCount
    };
  }
};
</script>
