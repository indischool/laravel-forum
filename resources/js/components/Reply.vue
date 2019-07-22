<template>
    <div :id="'reply-' + id" class="card mb-3">
        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name"></a>
                    said {{ data.created_at }}...
                </h5>

                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-sm btn-primary" @click="update">저장</button>
                <button class="btn btn-sm btn-link" @click="editing = false">취소</button>
            </div>
            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer level" v-if="canUpdate">
            <button class="btn btn-secondary btn-sm mr-1" @click="editing = true">수정</button>
            <button class="btn btn-danger btn-sm mr-1" @click="destroy">삭제</button>
        </div>
    </div>
</template>
<script>
    import Favorite from './Favorite.vue'

    export default {
        props: ["data"],

        components: {Favorite},

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }
        },

        methods: {
            update() {
                axios.patch("/replies/" + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash("수정되었습니다!");
            }
            ,
            destroy() {
                axios.delete("/replies/" + this.data.id);

                this.$emit('deleted', this.data.id);
            }
        }
    }
    ;
</script>
