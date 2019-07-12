import axios from 'axios'

const LOGIN_SUCCESS = 'LOGIN_SUCCESS'
const LOGOUT = 'LOGOUT'

export default {
    namespaced: true,

    state: {
        isLoggedIn: false
    },

    mutations: {
        [LOGIN_SUCCESS](state) {
            state.isLoggedIn = true
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

                    if (data.access_token == undefined) {
                        throw Error()
                    }

                    commit(LOGIN_SUCCESS)
                    /* remember token */
                    localStorage.setItem('access_token', data.token.access_token)
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
            return state.isLoggedIn
        }
    }
}
