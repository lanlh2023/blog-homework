import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';

import addEdit from './components/user/AddEdit.vue'

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

const admin_app = new Vue({
    el: '#admin',
    store
});
