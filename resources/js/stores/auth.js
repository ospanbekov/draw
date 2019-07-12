import axios from 'axios'

const LOGIN_SUCCESS = 'LOGIN_SUCCESS'
const LOGOUT = 'LOGOUT'

export default {
    namespaced: true,

    state: {
        accessToken: localStorage.getItem('access_token'),
        isLoggedIn: false
    },

    mutations: {
        [LOGIN_SUCCESS](state, accessToken) {
            state.isLoggedIn  = true
            state.accessToken = accessToken
        },

        [LOGOUT](state) {
            state.isLoggedIn = false
        }
    },

    actions: {
        login({dispatch, commit}, credentials) {
            return axios
                .post('/api/auth.json', credentials)
                .then((response) => {
                    let data = response.data

                    if (data.access_token === undefined) {
                        throw Error()
                    }

                    commit(LOGIN_SUCCESS, data.access_token)
                    /* remember token */
                    localStorage.setItem('access_token', data.access_token)
                })
        },

        logout({commit}) {
            commit(LOGOUT)
            /* forget token */
            localStorage.removeItem('access_token')
        }
    },

    getters: {
        isLoggedIn: state => {
            return state.isLoggedIn || state.accessToken // TODO: make check auth method ...
        },

        accessToken: state => {
            return state.accessToken
        }
    }
}
