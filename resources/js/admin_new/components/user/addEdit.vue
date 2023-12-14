<template>
    <form enctype="multipart/form-data" id="register-form" ref="registerForm" method="post">
        <div class="row mt-3">
            <div class="col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <group-input v-for="(input, key) in inputs" :key="key" :input="input" @setup-form="handleSetupUser">
                        </group-input>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-add-post" @click.prevent="saveUser">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { reactive } from "vue";
import groupInput from "../form/groupInput.vue";

export default {
    name: "AddEdit",
    props: ['id'],
    components: {
        groupInput,
    },
    data() {
        return {
            inputs: reactive({
                id: {
                    id: "userID",
                    name: "id",
                    type: "text",
                    label: "ID:",
                    placeholder: "",
                    error: '',
                    value: '',
                    hidden: true,
                },
                email: {
                    id: "email",
                    name: "email",
                    type: "text",
                    label: "Email:",
                    placeholder: "",
                    error: '',
                    value: '',
                },
                name: {
                    id: "name",
                    name: "name",
                    type: "text",
                    label: "Name:",
                    placeholder: "",
                    error: '',
                    value: '',
                },
                avatar: {
                    id: "avatar",
                    name: "avatar",
                    type: "file",
                    label: "Avatar:",
                    placeholder: "",
                    error: '',
                    value: '',
                },
                password: {
                    id: "password",
                    name: "password",
                    type: "password",
                    label: "Password:",
                    placeholder: "",
                    error: '',
                    value: '',
                },
                password_confirmation: {
                    id: "password_confirmation",
                    name: "password_confirmation",
                    type: "password",
                    label: "Password Confirmation:",
                    placeholder: "",
                    error: '',
                    value: '',
                },
            }),
            user: {},
            url: "/api/user/store",
        };
    },
    mounted() {
        if (this.id) {
            this.fetchUser()
                .then(() => {
                    this.setInputs();
                    this.url = `/api/user/update/${this.id}`;
                });
        }
    },
    methods: {
        async saveUser() {
            if ($(this.$refs.registerForm).valid()) {
                const formData = new FormData();
                for (const [key, value] of Object.entries(this.user)) {
                    if(this.inputs.hasOwnProperty(key)) {
                        if(key === 'avatar' && !(value instanceof File)) continue
                        formData.append(key, value);
                    }
                }

                try {
                    const response = await this.axios.post(this.url, formData);
                    if (!this.id) {
                        this.resetUser();
                        $(this.$refs.registerForm)[0].reset();
                    }
                    loadNotification({ success: response.data.success, message: response.data.message });
                } catch (error) {
                    switch (error.response.status) {
                        case 500: {
                            loadNotification({ success: error.response.data.success, message: error.response.data.message });
                            break;
                        }
                        case 422: {
                            const errors = Object.fromEntries(Object.entries(error.response.data.errors).map(([key, value]) => [key, value[0]]));
                            Object.entries(errors).forEach(([key, value]) => {
                                this.inputs[key].error = value;
                            });
                            break;
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
        },
        async fetchUser() {
            try {
                const response = await this.axios.get(`/api/user/edit/${this.id}`);
                this.user = JSON.parse(JSON.stringify(response.data.user));
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
        setInputs() {
            if (!this.user) return;
            for (const [key, value] of Object.entries(this.inputs)) {
                if(this.inputs[key].type == 'file') {
                    continue;
                }
                if (this.user.hasOwnProperty(this.inputs[key].name)) {
                    this.inputs[key].value = this.user[this.inputs[key].name];
                }

            }
        }
    },
};
</script>

<style lang="css" scoped></style>
