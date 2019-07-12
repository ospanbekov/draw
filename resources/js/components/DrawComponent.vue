<template>
    <div class="draw-component">
        <div class="draw-wrap">
            <div class="draw-game">
                <div class="draw-result"></div>
                <button class="draw-button" @click.prevent="submitDraw()">Играть</button>
            </div>
            <div class="draw-list" v-if="draws.length > 0">
                <div class="draw-item" v-for="draw in draws">
                    <div class="draw-name">Игра №{{ draw.id }}</div>
                    <div class="draw-prize">
                        <span v-if="draw.type == 0">Money - {{ draw.amount }}</span>
                        <span v-if="draw.type == 1">Bonus - {{ draw.amount }}</span>
                        <span v-if="draw.type == 2">Item - {{ draw.type }}</span>
                    </div>
                </div>
            </div>
        </div>

        <modal-component ref="ResultModalComponent" title="Результат игры">

        </modal-component>
    </div>
</template>

<style lang="stylus">
    .draw-wrap
        margin 0 auto
        position absolute
        top 50%
        left 50%
        transform translate(-50%, -50%)

    .draw-list
        max-width 200px
        min-width 200px
        margin-top 20px
        box-shadow 0px 0px 30px -10px rgba(0,0,0,0.1)
    .draw-item
        width 100%
        padding 20px
        border-bottom solid 1px #EEE

        &:last-child
            border-bottom none

    .draw-game
        text-align center

    .draw-button
        cursor pointer
        display inline-block
        font-size 1.2rem
        font-weight bold
        color #fff
        text-decoration none
        text-shadow 0 -1px rgba(0,0,0,.5)
        user-select none
        padding .7em 1.5em
        border 1px solid rgb(80,32,0)
        border-radius 5px
        outline none
        background rgb(147,80,36) linear-gradient(rgb(106,58,26), rgb(147,80,36) 80%)
        box-shadow 0 6px rgb(86,38,6), 0 3px 15px rgba(0,0,0,.4), inset 0 1px rgba(255,255,255,.3), inset 0 0 3px rgba(255,255,255,.5)
        transition .2s
        &:hover
            background rgb(167,91,41) linear-gradient(rgb(126,69,31), rgb(167,91,41) 80%)
        &:active
            background rgb(120,63,25) linear-gradient(rgb(120,63,25) 20%, rgb(167,91,41))
            box-shadow 0 2px rgb(86,38,6), 0 1px 6px rgba(0,0,0,.4), inset 0 1px rgba(255,255,255,.3), inset 0 0 3px rgba(255,255,255,.5)
            transform translate(0, 4px)
</style>

<script>
    import ModalComponent from './ModalComponent'

    export default {
        components: {
            'modal-component': ModalComponent
        },

        data () {
            return {
                draws: [],
                draw: {} // last result
            }
        },

        mounted () {
            this.fetchCurrentDraw()
        },

        methods: {
            submitDraw () {
                axios
                    .post('/api/draw.json')
                    .then((response) => {
                        this.draw = response.draw
                    })
            },

            fetchDrawList () {
                axios
                    .get('/api/draws.json')
                    .then((response) => {
                        this.draws = response.data.draws
                        /* show result in modal */
                        this.$refs.ResultModalComponent.open()
                        /* refresh list */
                        this.fetchDrawList()
                    })
            },

            exchangeLastDraw () {
                axios
                    .post('/api/draw/exchange.json')
                    .then((response) => {

                    })
            },

            rejectLastDraw () {
                axios
                    .post('/api/draw/reject.json')
                    .then((response) => {

                    })
            }
        }
    }
</script>
