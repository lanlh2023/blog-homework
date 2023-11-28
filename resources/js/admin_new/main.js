import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';

import addEditUser from './components/user/AddEditUser.vue'
import userList from './components/user/UserList.vue'
import Pagination from './components/pagination/Pagination.vue';
/**
 * Plugins
 */
Vue.use(VueAxios, axios);
/**
 * Setup app
 */
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Register Vue components
 */
Vue.component('add-edit-user', addEditUser);
Vue.component('user-list', userList);
Vue.component('pagination', Pagination);

const admin_app = new Vue({
    el: '#admin',
    store
});
