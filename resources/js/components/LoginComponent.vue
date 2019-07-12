<template>
    <div class="login-component">
        <modal-component ref="modal" title="Авторизация">
            <form class="auth-form" method="POST" @submit.prevent="submitLogin()">
                <div class="auth-form-item">
                    <label>Email</label>
                    <input v-model="postData.email" type="email" name="email" placeholder="Введите Email" /><span class="error" v-if="errors.email">{{ errors.phone[0] }}</span>
                </div>
                <div class="auth-form-item">
                    <label>Пароль</label>
                    <password-component v-model="postData.password" placeholder="Введите пароль"></password-component><span class="error" v-if="errors.password">{{ errors.password[0] }}</span><span class="error" v-if="errors.exception">{{ errors.exception }}</span>
                </div>
                <div class="auth-form-item auth-form-action">
                    <button class="auth-button" type="submit">Вход</button>
                </div>
            </form>
        </modal-component>
    </div>
</template>

<style lang="stylus">
    /*
    * Form
    */
    .auth-form
    .auth-form-item
    margin-top 18px
         &:first-child
                 margin-top 0px
                             label
                             color #333
                             font-weight 600
    font-size 0.92rem
                  display block
                  margin-bottom 10px
                                  .auth-form-action
                                  display flex
                                  flex-wrap nowrap
                                  flex-direction row
                                  justify-content flex-start
                                  align-items center
                                  span.error
                                  color red
                                  font-size 0.8rem
                                               line-height 15px
                                                             margin-top 10px
                                                                          display block
                                                                          input
                                                                          font-size 0.9rem
                                                                                       width 100%
    display block
    padding-top 14px
                  padding-bottom 14px
                                   padding-left 15px
                                                  padding-right 15px
                                                                  border solid 2px #CCC
                                                                                border-radius 3px
                                                                                               box-shadow none
                                                                                               input
        &::-webkit-input-placeholder
                                                                                               color #AAA
    &::-moz-placeholder
     color #AAA
    &:-ms-input-placeholder
     color #AAA
    &:-moz-placeholder
     color #AAA
     button::-moz-focus-inner
     padding 0
    border 0
    .auth-button
    color #FFF
    border none
    border-radius 3px
                   padding 10px 14px
                                  background-color #0277bd
</style>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import ModalComponent from './ModalComponent'
    import PasswordComponent from './PasswordComponent'
    export default {
        components: {
            'modal-component': ModalComponent,
            'password-component': PasswordComponent
        },

        data () {
            return {
                showPassword: false,
                errors: {},

                postData: {
                    login: null,
                    password: null
                }
            }
        },
        computed: {
            ...mapGetters({
                isLoggedIn: 'auth/isLoggedIn'
            })
        },
        methods: {
            ...mapActions({
                attempLogin: 'auth/login'
            }),
            show () {
                this.$refs.modal.open()
            },

            hide () {
                this.$refs.modal.close()
            },
            submitLogin () {
                this.attempLogin(this.postData)
                    .then((response) => {
                        /* clear errors */
                        this.errors = {}
                    })
                    .catch((error) => {
                        if (!error.response) {
                            return
                        }
                        let data = error.response.data

                        if (data.errors) {
                            this.errors = data.errors
                        } else {
                            this.errors = {}
                        }
                    })
            },
            triggerPassword () {
                this.showPassword = this.showPassword ^ true
            }
        }
    }
</script>
