<template>
    <div class="content-table col-12">
        <table class="table table-striped table-hover table-bordered align-middle table-responsive">
            <thead>
                <tr>
                    <th class="align-middle" scope="col" style="width: 5%"><label>ID</label></th>
                    <th class="align-middle" scope="col" style="width: 20%"><label>User Name</label></th>
                    <th class="align-middle" scope="col" style="width: 20%"><label>Avatatar</label></th>
                    <th class="align-middle" scope="col" style="width: 20%"><label>Position Name</label></th>
                    <th class="align-middle" scope="col" style="width: 10%"><label>Created Date</label></th>
                    <th class="align-middle" scope="col" style="width: 10%"><label>Updated Date</label></th>
                    <th class="align-middle" scope="col" style="width: 15%"><label>Action</label></th>
                </tr>
            </thead>
            <tbody>
                <User v-for="user in users" :key="user.id" :user="user" :path="path">
                </User>
            </tbody>
        </table>
    </div>
</template>

<script>
import User from './User.vue'
export default {
    name: 'Table',

    data() {
        return {

        };
    },
    props: {
        users: {
            type: Array,
            required: true,
        },
        path: {
            type: String,
            required: true,
        },
    },
    components: {
        User,
    },
    mounted() {
    },

    methods: {

    },
};
</script>

<style lang="scss" scoped></style>
