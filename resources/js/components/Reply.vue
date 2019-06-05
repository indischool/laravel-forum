<script>
export default {
  props: ["attributes"],
  data() {
    return {
      editing: false,
      body: this.attributes.body
    };
  },
  methods: {
    update() {
      axios.patch("/replies/" + this.attributes.id, {
        body: this.body
      });

      this.editing = false;

      flash("수정되었습니다!");
    },
    destroy() {
      axios.delete("/replies/" + this.attributes.id);

      $(this.$el).fadeOut(300, () => {
        flash("댓글이 삭제되었습니다.");
      });
    }
  }
};
</script>
