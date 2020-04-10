
//installing vuex
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);


//setting if app is in production mode or not
const debug = process.env.NODE_ENV !== 'production';


//importing modules

import createPersistedState from "vuex-persistedstate";
import html from './modules/html';
import system from './modules/system';
import panel from './modules/panel';

export default new Vuex.Store({
    strict: debug,

    plugins: [createPersistedState({
        paths: ['system'],
    })],

    modules: {
        html,
        system,
        panel,
    },
});