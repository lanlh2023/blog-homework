<template>
    <div class="col-12 col-xl-10 col-lg-9 col-md-9 content-table-wrap">
        <NotiFy></NotiFy>
        <div class="pagination-wrap d-flex justify-content-end px-4 pt-4">
            <pagination v-if="users.data && users.data.length > 0" :meta="users.meta" @page-change="pageChange" />
        </div>
        <div class="table w-100 py-4">
            <formSearch @search="searchByNameAndPosition"></formSearch>
            <div class="content-table col-12">
                <table-user v-if="users.data && users.data.length > 0" :users="users.data"></table-user>
                <div class="d-flex justify-content-center" style="font-size: 20px" v-else>
                    No User Found
                </div>
            </div>
            <div class="btn-group m-3">
                <a :href="path + '/create'" class="btn btn-primary d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 448 512">
                        <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                    </svg>
                    Add
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue';
import NotiFy from '../notification/notify.vue';
import tableUser from './table.vue';
import formSearch from './formSearch.vue';

export default {
    name: 'userList',
    data() {
        return {
            users: reactive({}),
            currentPage:ref(1),
            searchConditions: reactive({}),
        };
    },
    components: {
        NotiFy,
        tableUser,
        formSearch,
    },
    props: [
        'path',
    ],
    mounted() {
        this.getUserList();
        this.$store.commit('setPath', this.path);
    },
    computed: {},
    methods: {
        async getUserList() {
            try {
                const response = await this.axios.get('/api/user?page=' + this.currentPage, { params: this.searchConditions });
                this.users = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        pageChange(page) {
            this.currentPage = page;
            this.getUserList();
        },
        setPath() {
            this.$store.commit('setPath', this.path);
        },
        searchByNameAndPosition(searchConditions) {
            this.currentPage = 1;
            this.searchConditions = searchConditions;
            this.getUserList();
        }
    },
};
</script>
