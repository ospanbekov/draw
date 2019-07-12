import {mapActions, mapGetters} from 'vuex'

import Vue from 'vue'
import AppStore from './stores/index'

import LoginComponent from './components/LoginComponent'

/* init main app */
new Vue({
    el: '#App',
    store: AppStore,
    components: {
        'login-component': LoginComponent
    },
    data: () => {
        return {};
    },

    computed: {
        ...mapGetters({
            isLoggedIn: 'auth/isLoggedIn'
        })
    },

    mounted () {
        if (!this.isLoggedIn) {
            this.$refs.LoginComponent.show()
        }
    },

    methods: {}
});
