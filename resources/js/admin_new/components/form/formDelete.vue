<template>
    <vk-modal :show.sync="show">
        <vk-modal-title>Delete confirm</vk-modal-title>
        <p>Delete model with id {{ model.id }}.</p>
        <p class="uk-text-right">
            <vk-button @click="handleClick" class="uk-margin-small-right secondart">Cancel</vk-button>
            <vk-button type="danger" class="danger" @click="handleClickSave">Delete</vk-button>
        </p>
    </vk-modal>
</template>

<script>
export default {
    name: 'FormDelete',
    props: ['model', 'show'],
    data() {
        return {

        };
    },

    mounted() {

    },

    methods: {
        handleClick(){
            this.$emit('set-show');
        },
        handleClickSave() {
            this.$emit('delete-model');
        }
    },
};
</script>

<style lang="scss" scoped></style>
