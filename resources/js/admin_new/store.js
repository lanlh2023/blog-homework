import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        path: '',
    },
    mutations: {
        setPath(state, path) {
            state.path = path;
        }
    },
});

export default store;
