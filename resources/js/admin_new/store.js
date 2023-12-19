import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        path: JSON.parse(localStorage.getItem('state-path')),
        message: JSON.parse(localStorage.getItem('state-message'))
    },
    mutations: {
        setMessage(state, message) {
            localStorage.setItem('state-message', JSON.stringify(message));
            state.message = message;

        },
        setPath(state, path) {
            localStorage.setItem('state-path', JSON.stringify(path));
            state.path = path;
        }
    },
    actions: {},
    getters: {}
});

export default store;
