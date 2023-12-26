<template>
    <div class="content-table col-12">
        <table class="table table-striped table-hover table-bordered align-middle table-responsive">
            <thead>
                <tr>
                    <th class="align-middle" scope="col" style="width: 5%"><label>ID</label></th>
                    <th class="align-middle" scope="col" style="width: 20%"><label>User Name</label></th>
                    <th class="align-middle" scope="col" style="width: 20%"><label>Avatar</label></th>
                    <th class="align-middle" scope="col" style="width: 20%"><label>Position Name</label></th>
                    <th class="align-middle" scope="col" style="width: 10%"><label>Created Date</label></th>
                    <th class="align-middle" scope="col" style="width: 10%"><label>Updated Date</label></th>
                    <th class="align-middle" scope="col" style="width: 15%"><label>Action</label></th>
                </tr>
            </thead>
            <tbody>
                <row v-for="user in users" :key="user.id" :user="user">
                </row>
            </tbody>
        </table>
    </div>
</template>

<script>
import row from './row.vue'
export default {
    name: 'tableUser',
    data() {
        return {
        };
    },
    props: {
        users: {
            type: Array,
            required: true,
        },
    },
    components: {
        row,
    },
};
</script>
