<template>
    <div>
        <button type="submit" :class="classes" @click="toggle">
            <span><i class="fas fa-heart"></i></span>
            <span v-text="count"></span>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },
        computed: {
            classes() {
                return ['btn', this.active ? 'btn-outline-primary' : 'btn-primary']
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },
        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint);
                this.active = true;
                this.count++;
            },

            destroy() {
                axios.delete(this.endpoint);
                this.active = false;
                this.count--;
            }
        }
    };
</script>
