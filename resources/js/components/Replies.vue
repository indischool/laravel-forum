<template>
    <div>
        <div v-for="(reply, index) in items">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply.vue';

    export default {
        props: ['data'],

        components: {Reply},

        data() {
            return {
                items: this.data
            }
        },

        methods: {
            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed');

                flash('댓글이 삭제되었습니다.');
            }
        }

    }
</script>

<style scoped>

</style>