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
    </div>
</template>

<style lang="stylus">
</style>

<script>
    export default {
        data () {
            return {
                draws: []
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
