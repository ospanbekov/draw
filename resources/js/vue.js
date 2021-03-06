import {mapActions, mapGetters} from 'vuex'

import Vue from 'vue'
import AppStore from './stores/index'

import LoginComponent from './components/LoginComponent'
import DrawComponent from './components/DrawComponent'

/* init main app */
new Vue({
    el: '#App',
    store: AppStore,
    components: {
        'login-component': LoginComponent,
        'draw-component': DrawComponent
    },
    data: () => {
        return {};
    },

    computed: {
        ...mapGetters({
            isLoggedIn: 'auth/isLoggedIn'
        })
    },

    created () {

    },

    mounted () {
        if (!this.isLoggedIn) {
            this.$refs.LoginComponent.show()
        }
    },

    methods: {}
});
