<template>
    <div class="draw-component">
        <div class="draw-wrap">
            <div class="draw-list" v-if="draws.length > 0">
                <div class="draw-item" v-for="draw in draws">
                    <div class="draw-name">Игра №{{ draw.id }}</div>
                    <div class="draw-prize">{{ draw.type }}</div>
                </div>
            </div>
        </div>

        <div class="draw-game">
            <div class="draw-result"></div>
            <button class="draw-button">Играть</button>
        </div>
    </div>
</template>

<style lang="stylus">
    .draw-wrap
        margin 0 auto
        position absolute
        top 50%
        left 50%
        transform translate(-50%, -50%)
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
    export default {
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
            draw() {
                axios
                    .post('/api/draw.json')
                    .then((response) => {
                        this.draw = response.draw
                    })
            },

            fetchCurrentDraw() {
                axios
                    .get('/api/draws.json')
                    .then((response) => {
                        this.draws = response.data.draws
                    })
            }
        }
    }
</script>
