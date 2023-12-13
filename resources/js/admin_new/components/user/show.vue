<template>
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        <div class="content-detail card shadow" id="content-user-detail">
            <div class="card-header w-100 d-dlex flex-column align-items-center">
                <div class="d-flex justify-content-center">
                    <img class="object-fit-cover rounded-circle avatar-user-show border w-100" :src="user.avatar" alt="">
                    <div class="ml-3 d-flex flex-column justify-content-around">
                        <h2>{{ user.name }}</h2>
                        <h4 class="text-break">{{ user.email }}</h4>
                        <span class="flex-1 text-muted">Join {{ user.created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
        <button @click="show = true" class="btn btn-danger btn-delete-vue mt-3"><svg xmlns="http://www.w3.org/2000/svg"
                height="1.25em" viewBox="0 0 448 512">
                <path
                    d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
            </svg>
            delete
        </button>
        <FormDelete :model="user" :show="show" @set-show="handleCancel" @delete-model="handleDelete"></FormDelete>
    </div>
</template>

<script>
import { ref } from 'vue';
import FormDelete from '../form/formDelete.vue';
export default {
    name: 'show',
    props: {
        id: {
            type: String,
            required: true,
        },
    },
    components: {
        FormDelete
    },
    data() {
        return {
            user: {},
            show: ref(false),
        };
    },
    mounted() {
        this.fetchUser();
    },
    methods: {
        async fetchUser() {
            try {
                const response = await this.axios.get(`/api/user/show/${this.id}`);
                this.user = response.data.user;
            } catch (error) {
                switch (error.response.status) {
                    case 500: {
                        loadNotification({ success: error.response.data.success, message: error.response.data.message });
                        break;
                    }
                    default: {
                        console.log(error);
                        break;
                    }
                }
            }
        },
        handleCancel() {
            this.show = false;
        },
        async handleDelete() {
            this.show = false;
            try {
                const response = await this.axios.post(`/api/user/destroy/${this.id}`);
                if (response.data.success) {
                    this.$store.commit('setMessage', { status: 'success', message: response.data.message });
                    window.location.href = this.$store.state.path;
                }
            } catch (error) {
                console.log('catch');
                debugger
                switch (error.response.status) {
                    case 500: {
                        loadNotification({ success: error.response.data.success, message: error.response.data.message });
                        break;
                    }
                    default: {
                        console.log(error);
                        break;
                    }
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped></style>
