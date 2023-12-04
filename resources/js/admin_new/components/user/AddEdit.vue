<template>
    <form enctype="multipart/form-data" id="register-form" ref="registerForm" method="post">
        <div class="row mt-3">
            <div class="col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <GroupInput v-for="(input, key) in inputs" :key="key" :input="input" @setup-form="handleSetupUser">
                        </GroupInput>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-add-post" @click.prevent="createUser">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { reactive } from "vue";
import GroupInput from "../form/GroupInput.vue";

export default {
    name: "AddEdit",
    components: {
        GroupInput,
    },
    data() {
        return {
            inputs: reactive({
                email: {
                    id: "email",
                    name: "email",
                    type: "text",
                    label: "Email:",
                    placeholder: "",
                    error: '',
                },
                name: {
                    id: "name",
                    name: "name",
                    type: "text",
                    label: "Name:",
                    placeholder: "",
                    error: '',
                },
                avatar: {
                    id: "avatar",
                    name: "avatar",
                    type: "file",
                    label: "Avatar:",
                    placeholder: "",
                    error: '',
                },
                password: {
                    id: "password",
                    name: "password",
                    type: "password",
                    label: "Password:",
                    placeholder: "",
                    error: '',
                },
                password_confirmation: {
                    id: "password_confirmation",
                    name: "password_confirmation",
                    type: "password",
                    label: "Password Confirmation:",
                    placeholder: "",
                    error: '',
                },
            }),
            user: {},
        };
    },
    methods: {
        async createUser() {
            if ($(this.$refs.registerForm).valid()) {
                const formData = new FormData();
                for (const [key, value] of Object.entries(this.user)) {
                    formData.append(key, value);
                }
                try {
                    const response = await this.axios.post("/api/user/store", formData);
                    this.resetUser();
                    $(this.$refs.registerForm)[0].reset();
                    loadNotification({ success: response.data.success, message: response.data.message });
                } catch (error) {
                    switch (error.response.status) {
                        case 500: {
                            loadNotification({ success: error.response.data.success, message: error.response.data.message });
                            break;
                        }
                        case 400: {
                            const errors = Object.fromEntries(Object.entries(error.response.data.errors).map(([key, value]) => [key, value[0]]));
                            Object.entries(errors).forEach(([key, value]) => {
                                this.inputs[key].error = value;
                            });
                        }
                        default: {
                            console.log(error);
                            break;
                        }
                    }
                }
            }
        },
        handleSetupUser(name, value) {
            this.user = { ...this.user, [name]: value };
        },
        resetUser() {
            Object.entries(this.user).forEach(([name, value]) => {
                this.user[name] = '';
            });
        }
    },
};
</script>

<style lang="css" scoped></style>
