import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';
import Vuikit from 'vuikit';
import VuikitIcons from '@vuikit/icons';
import '@vuikit/theme'

import addEdit from './components/user/AddEdit.vue'
import List from './components/user/List.vue'
import show from './components/user/Show.vue'
import pagination from './components/pagination/Pagination.vue'

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
Vue.component('user-list', List);
Vue.component('show-user', show);
Vue.component('pagination', pagination);

const admin_app = new Vue({
    el: '#admin',
    store
});
