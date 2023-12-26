<template>
    <div class="row container mx-0 pb-3">
        <div class="col-md-6 col-12">
            <group-input v-for="(input, key) in inputs" :key="key" :input="input" @setup-form="handleSetupKeyWork">
            </group-input>
        </div>
        <div class="col-6 col-md-6 col-12">
            <label for="positision">Positision Name</label>
            <div class="d-flex">
                <select name="" id="positision" class="w-100 form-control" @change="handleOnchangeSelect($event)">
                    <option value="0">
                        Chose positision
                    </option>
                    <option value="1">
                        Admin
                    </option>
                    <option value="2">
                        Editor
                    </option>
                    <option value="3">
                        User
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import groupInput from "../form/groupInput.vue";
import _ from "lodash";

export default {
    name: 'FormSearch',
    components: {
        groupInput,
    },
    data() {
        return {
            inputs: reactive({
                search: {
                    id: "search",
                    name: "name",
                    type: "text",
                    label: "Name:",
                    placeholder: "",
                    error: '',
                    value: '',
                },
            }),
            conditions: reactive({}),
        };
    },
    methods: {
        handleSetupKeyWork: _.debounce(function (name, value) {
            this.conditions = { ...this.conditions, [name]: value };
            this.$emit('search', this.conditions);
        }, 200),
        handleOnchangeSelect: _.debounce(function (e) {
            this.conditions = { ...this.conditions, 'role_id': e.target.value };
            this.$emit('search', this.conditions);
        }, 200),
    },
};
</script>

<style lang="scss" scoped></style>
