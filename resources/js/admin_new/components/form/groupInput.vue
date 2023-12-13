<template>
    <div class="mb-3" v-show="input.hidden != true">
        <label :for="input.id" class="form-label">{{ input.label }}
        </label>
        <input
            class="form-control"
            :type="input.type"
            :name="input.name"
            :id="input.id"
            :placeholder="input.placeholder"
            :value="inputValue"
            :data-content="input.label"
            @input="handldeChange"
            />
            <div class="error-div" :class="`error ${input.name}`">
            <label :id="`${input.name}-error`" class="error text-danger" :for="input.name">
                {{ input.error }}
            </label>
        </div>
    </div>
</template>
<script>
export default {
    name: 'groupInput',
    props: {
        input: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
    },
    computed: {
        inputValue: {
            get() {
                return this.input.value;
            },
            set(value) {
                this.$emit("setup-form", this.input.name, value);
            },
        },
    },
    methods: {
        handldeChange($event) {
            let value = $event.target.value;
            if ($event.target.type == 'file') {
                value = $event.target.files[0];
            }
            this.$emit('setup-form', $event.target.name, value);
        }
    },
};
</script>
<style lang="scss" scoped></style>
