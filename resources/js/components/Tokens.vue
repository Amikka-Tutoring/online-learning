<template>
    <div class="row mb-4" :class="this.class">
        <div class="d-flex align-items-center">
            <img src="/images/tokens.png" alt="">
            <h1>{{ tokens }} Tokens</h1></div>
    </div>
</template>

<script>
export default {
    name: "Tokens",
    props: ['class'],
    data() {
        return {
            tokens: null
        }
    },
    methods: {
        getTokens: function () {
            axios.get(route('get.tokens')).then(response => {
                this.tokens = response.data.tokens
            }).catch(error => {
                console.log(error.response)
            })
        }
    },
    mounted() {
        this.getTokens()
    }
}
</script>

<style scoped>

</style>
