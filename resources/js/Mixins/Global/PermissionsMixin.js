import Vue from 'vue';

const app = document.getElementById('app')
const page = JSON.parse(app.dataset.page);

Vue.mixin({
    data: () => ({
        userPermissions: [],
    }),
    mounted() {
        if (page.props.auth.user === null) return; 
        this.userPermissions = page.props.auth.user.permissions || [];
    },
    methods: {
        userCan(permission) {
            if (this.userPermissions === [] || this.userPermissions.length == 0) return false
            return this.userPermissions.includes(permission)
        }
    },

});