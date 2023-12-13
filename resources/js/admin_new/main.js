import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';
import Vuikit from 'vuikit';
import VuikitIcons from '@vuikit/icons';
import '@vuikit/theme'

import addEdit from './components/user/AddEdit.vue'
import show from './components/user/show.vue'
import userList from './components/user/list.vue'
import pagination from './components/pagination/pagination.vue'

/**
 * Plugins
 */
Vue.use(VueAxios, axios);
Vue.use(Vuikit);
Vue.use(VuikitIcons);
/**
 * Setup app
 */
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Register Vue components
 */
Vue.component('add-edit-user', addEdit);
Vue.component('show-user', show);
Vue.component('user-list', userList);
Vue.component('pagination', pagination);

const admin_app = new Vue({
    el: '#admin',
    store
});
