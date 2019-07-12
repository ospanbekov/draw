<template>
    <div class="auth-form-password">
        <div class="auth-password-wrap">
            <input ref="passwordInput" name="password" @input="updatePassword()" v-bind:type="showPassword ? 'text' : 'password'" v-bind:value="value" v-bind:placeholder="placeholder" /><a class="trigger-password-btn" href="#" @click.prevent="triggerPassword" v-bind:class="showPassword ? 'showed-password' : 'hidden-password'"></a>
        </div>
    </div>
</template>

<style lang="stylus">
    .auth-form-password
        .auth-input-wrap
            position relative
        .auth-password-wrap
            position relative
        .auth-password-hint
            color #666
            font-size 0.8rem
            display block
            margin-top 10px
        .trigger-password-btn
            width 28px
            height 28px
            background-repeat no-repeat
            opacity 0.5
            position absolute
            top 50%
            right 15px
            transform translateY(-50%)
            display inline-block
                &.showed-password
                    background-position center
                    background-size 90%
                    background-image url('/static/images/icons/eye-view.svg')
            &.hidden-password
                background-position center bottom
                background-size 80%
                background-image url('/static/images/icons/eye-hide.svg')
</style>

<script>
    export default {
        props: {
            value: {
                type: String,
                default () {
                    return null
                }
            },

            placeholder: {
                type: String,
                default () {
                    return null
                }
            }
        },

        data () {
            return {
                showPassword: false
            }
        },
        methods: {
            updatePassword () {
                this.$emit('input', this.$refs.passwordInput.value)
            },
            triggerPassword () {
                this.showPassword = this.showPassword ^ true
            }
        }
    }
</script>
