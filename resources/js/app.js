/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue';
import VueMeta from 'vue-meta';
import Vuetify from './Plugins/Vuetify';
import { InertiaApp } from '@inertiajs/inertia-vue';
import store from './Store';

import './Plugins/Validation';
import './Mixins/Global';

Vue.use(VueMeta)
Vue.use(InertiaApp)

const app = document.getElementById('app')
const page = JSON.parse(app.dataset.page);

new Vue({
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - ${page.props.app.name}` : `${page.props.app.name}`
    },
    render: h => h(InertiaApp, {
        props: {
            initialPage: page,
            resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
        }
    }),
    vuetify: Vuetify,
    store
}).$mount(app)