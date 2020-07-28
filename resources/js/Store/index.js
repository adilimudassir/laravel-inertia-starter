import Vue from 'vue';
import Vuex from 'vuex';
import flashMessage from './modules/flashMessage'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        flashMessage,
    }
});