<template>
    <form enctype='multipart/form-data' id="register-form" ref="registerForm" method="post">
        <div class="row mt-3">
            <div class="col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <!-- {{ $pageTitle ?? 'Add edit user' }} -->
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <GroupInput v-for="(input, index) in getInpus" :key="index" :input="input" :errors="getErrors"
                            @setup-form-user="handleSetupUser">
                        </GroupInput>
                        <!-- <input type="text" hidden id="userID" value="{{ $user->id }}"> -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-add-post" @click.prevent="createUser"> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { reactive, ref } from "vue";
import GroupInput from "../form/GroupInput.vue";

export default {
    name: 'AddEdit',
    data() {
        return {
            inputs: reactive({
                email: {
                    'id': 'email',
                    'name': 'email',
                    'type': 'text',
                    'label': 'Email',
                    'plaplaceholderce': '',
                },
                name: {
                    'id': 'name',
                    'name': 'name',
                    'type': 'text',
                    'label': 'Name',
                    'plaplaceholderce': '',
                },
                avatar: {
                    'id': 'avatar',
                    'name': 'avatar',
                    'type': 'file',
                    'label': 'Avatr',
                    'plaplaceholderce': '',
                },
                password: {
                    'id': 'password',
                    'name': 'password',
                    'type': 'password',
                    'label': 'Password',
                    'plaplaceholderce': '',
                },
                password_confirmation: {
                    'id': 'password_confirmation',
                    'name': 'password_confirmation',
                    'type': 'password',
                    'label': 'Password Confirmation',
                    'plaplaceholderce': '',
                }
            }),
            user: {},
            errors: reactive({}),
        };
    },
    components: {
        GroupInput
    },
    mounted() {

    },
    computed: {
        getInpus() {
            return this.inputs;
        },
        getErrors() {
            return this.errors;
        }
    },
    methods: {
        async createUser() {
            if ($(this.$refs.registerForm).valid()) {
                const formData = new FormData();
                for (const [key, value] of Object.entries(this.user)) {
                    formData.append(key, value)
                }
                try {
                    const response = await this.axios.post('/api/user/store', formData);
                    $(this.$refs.registerForm)[0].reset();
                    loadNotification({ success: response.data.success, message: response.data.message });
                } catch (error) {
                    if (!error.response.data.success) {
                        loadNotification({ success: error.response.data.success, message: error.response.data.message });
                    } else {
                        const errors = Object.entries(error.response.data.errors);
                        const errorsObject = {};
                        errors.forEach(error => {
                            error = error.flat();
                            errorsObject[error[0]] = error[1];
                        })
                        this.errors = errorsObject
                    }
                }
            }
        },
        handleSetupUser(name, value) {
            this.user[name] = value;
        },
    },
};
</script>

<style lang="css" scoped></style>
