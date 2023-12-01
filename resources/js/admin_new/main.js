import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';

import addEdit from './components/user/AddEdit.vue'
import List from './components/user/List.vue'
import pagination from './components/pagination/Pagination.vue'

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
Vue.component('user-list', List);
Vue.component('pagination', pagination);

const admin_app = new Vue({
    el: '#admin',
    store
});
