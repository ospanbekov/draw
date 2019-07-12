import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import authStore from './auth'

var store = new Vuex.Store({
    modules: {
        auth: authStore
    }
})

export default store
