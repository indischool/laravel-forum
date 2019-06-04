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
    }
  }
};
</script>
