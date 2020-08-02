import Vue from 'vue';

const app = document.getElementById('app')
const page = JSON.parse(app.dataset.page);

Vue.mixin({
    created() {
        // this.dispatchFlashMessage();
    },
    methods: {
        dispatchFlashMessage() {
            if (this.$page.flash == null || typeof(this.$page.flash) == undefined) return;

            this.$store.dispatch('flashMessage', {
                text: this.$page.flash.message,
                type: this.$page.flash.type
            });

            // this.$page.flash = null;
        }
    },

});