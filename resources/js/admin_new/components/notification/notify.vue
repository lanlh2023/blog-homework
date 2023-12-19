<template>
    <div aria-live="polite" aria-atomic="true" id="wrap-toast" style="display: block;" :class="{ 'open-toast': show }">
        <div style="position: absolute; top: 0; right: 10px; width: 100%">
            <div class="toast" :class="{ 'show': show }">
                <div class="toast-header">
                    <strong class="mr-auto">Notification</strong>
                    <small class="text-muted">2 seconds ago</small>
                    <button type="button" class="ml-2 mb-1 close">
                        <span aria-hidden="true" @click="handleClickHideNotify">&times;</span>
                    </button>
                </div>
                <div id="toast-body" class="p-3 text-white"
                    :class="messages.status == 'success' ? 'bg-success' : 'bg-danger'" v-if="messages">
                    {{ messages.message }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: 'Notify',
    data() {
        return {
            messages: this.$store.state.message,
            show: ref(false),
        };
    },
    computed: {
    },
    mounted() {
        setTimeout(() => {
            this.show = this.$store.state.message != null ? true : false
        }, 1000),
        setTimeout(() => {
            this.handleClickHideNotify()
        }, 5000)
    },
    methods: {
        handleClickHideNotify() {
            if (this.$store.state.message != null) {
                this.$store.commit('setMessage', null)
                this.show = false
            }
        },
    },
};
</script>

<style lang="scss" scoped></style>
