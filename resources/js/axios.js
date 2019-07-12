import axios from 'axios'
import AppStore from './stores/index'

/* axios setup */
axios.interceptors.request.use((config) => {
    const accessToken = AppStore.getters['auth/accessToken']

    if (accessToken) {
        config.headers.Authorization = 'Bearer ' + accessToken
    } else {
        config.headers.Authorization = null
    }

    return config
})
