import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
import Vue from 'vue';
import { required, email, max, min, confirmed } from 'vee-validate/dist/rules'
/**
 *  Create components and set vee-validation settings
 */
setInteractionMode('eager');

extend('required', {
    ...required,
    message: '{_field_} can not be empty',
})

extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
})

extend('confirmed', {
    ...confirmed,
    message: '{_field_} must be confirmed',
})

extend('min', {
    ...min,
    message: '{_field_} may not be less than {length} characters',
})

extend('email', {
    ...email,
    message: 'Email must be valid',
})

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);