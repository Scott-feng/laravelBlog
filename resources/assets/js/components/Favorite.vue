<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(post)"><i class="glyphicon glyphicon-star"></i></a>
        <a href="#" v-else @click.prevent="favorite(post)"><i class="glyphicon glyphicon-star-empty"></i></a>
    </span>
</template>

<script>
    export default {
        name: "Favorite",
        data(){
            return {
                isFavorited:this.isFavorite,
            }
        },

        props: ['post','favorited'],

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed:{
            isFavorite(){
                return this.favorited;
            }
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/'+post)
                    .then(response=>this.isFavorited = true)
                    .catch(response=>console.log(response.data))
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response=>this.isFavorited = false)
                    .catch(response=>console.log(response.data))
            }
        },
        mounted() {
            console.log('favorite Component mounted.')
        }

    }
</script>

<style scoped>

</style>