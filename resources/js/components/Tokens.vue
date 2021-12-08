<template>
    <div class="row mb-4" :class="this.class">
        <div class="d-flex align-items-center">
            <img src="/images/tokens.png" alt="">
            <h1>{{ tokens.tokens }} Tokens</h1></div>
    </div>
</template>

<script>
export default {
    name: "Tokens",
    props: ['class', 'tokens'],
    data() {
        return {}
    },
    methods: {},
    mounted() {

    }
}
</script>

<style scoped>

</style>
