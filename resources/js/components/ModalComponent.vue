<template>
    <div class="modal-component">
        <div class="vue-modal" v-if="isShowed()">
            <div class="modal-overlay" @click.stop="close"></div>
            <div class="modal-wrap">
                <div class="modal-content">
                    <div class="modal-loader" v-if="isVisibleLoader"></div>
                    <div class="modal-close-btn" @click.prevent="close"></div>
                    <div class="modal-title" v-if="isVisibleTitle">{{ title }}</div>
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="stylus" scoped>
    .vue-modal
        width 100%
        height 100%
        overflow auto
        position fixed
        background-color rgba(0,0,0,0.7)
        top 0
        left 0
        z-index 9999
        @media screen and (max-width: 500px)
            background-color #FFFFFF
    .modal-overlay
        width 100%
        height 100%
        position absolute
        top 0
        left 0
        z-index 0
    .modal-loader
        width 100%
        height 100%
        background-color rgba(255,255,255,0.6)
        position absolute
        top 0
        left 0
        z-index 1
    .modal-wrap
        width 100%
        min-height 100%
        display flex
        flex-direction column
        align-items center
        justify-content center
        position relative
        z-index 9
    .modal-content
        width 450px
        padding 30px
        margin 20px 0px
        height auto
        background-color #FFF
        border-radius 5px
        box-shadow 0 0 50px 0px rgba(0,0,0,0.5)
        position relative
            @media screen and (max-width: 500px)
                max-width 100%
                width 100%
                margin 0px
                border-radius 0px
                box-shadow none
                top 0
                left 0
                transform none
    .modal-close-btn
        cursor pointer
        width 30px
        height 30px
        line-height 30px
        border-radius 30px
        text-align center
        opacity 0.4
        background-color #FFF
        background-image url('/static/images/icons/close.svg')
        background-repeat no-repeat
        background-position center center
        background-size 100%
        position absolute
        top 20px
        right 20px
        z-index 9999
        @media screen and (max-width: 500px)
            top 10px
            right 10px
    .modal-title
        color #CCC !important
        font-size 1.3rem
        font-weight 600
        margin-bottom 20px
</style>

<script>
    export default {
        props: {
            className: {
                default: null
            },
            visible: {
                default: false
            },
            title: {
                default: null
            }
        },
        data () {
            return {
                isVisibleModal: this.visible,
                isVisibleTitle: true,
                isVisibleLoader: false
            }
        },
        methods: {
            showTitle () {
                this.isVisibleTitle = true
            },
            hideTitle () {
                this.isVisibleTitle = false
            },
            isShowed () {
                return this.isVisibleModal
            },
            showLoader () {
                this.isVisibleLoader = true
            },
            hideLoader () {
                this.isVisibleLoader = false
            },
            close () {
                this.isVisibleModal = false
                /* event */
                this.$emit('closed')
            },
            open () {
                this.isVisibleModal = true
                /* event */
                this.$emit('showed')
            }
        }
    }
</script>
