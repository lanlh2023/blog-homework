import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';

import addEdit from './components/user/AddEdit.vue'
import userList from './components/user/list.vue'
import pagination from './components/pagination/pagination.vue'

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
Vue.component('add-edit-user', addEdit);
Vue.component('user-list', userList);
Vue.component('pagination', pagination);

const admin_app = new Vue({
    el: '#admin',
    store
});
