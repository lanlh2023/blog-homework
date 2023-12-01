<template>
    <div class="mb-3">
        <label :for="input.id" class="form-label">{{ input.label }}</label>
        <input :type="input.type" :name="input.name" :data-content="input.label" :id="input.id" class="form-control"
            :placeholder="input.placeholder" :v-model="input.name" @input="handldeChange">
        <div class="error-div" :class="`error` + input.name">
            <label :id="input.name + `erro`" class="error text-danger" :for="input.name">{{ errors[input.name] }}
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'GroupInput',
    props: ['input', 'errors'],
    data() {
        return {
        };
    },

    mounted() {
        console.log(this.errors);
    },
    methods: {
        handldeChange($event) {
            let value = $event.target.value;
            if($event.target.type == 'file') {
                value = $event.target.files[0];
            }
            this.$emit('setup-form-user',$event.target.name, value);
        }
    },
};
</script>

<style lang="scss" scoped></style>
