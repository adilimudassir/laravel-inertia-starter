/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import { InertiaApp } from '@inertiajs/inertia-vue'
import './plugins/Validation'
import VueMeta from 'vue-meta';

Vue.use(VueMeta)
Vue.use(InertiaApp)
Vue.use(Vuetify)
Vue.mixin({ methods: { route: window.route } })


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
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
        },
    })
}).$mount(app)