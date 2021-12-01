<template>
    <input class="form-control" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
           ref="input">
</template>

<script>
export default {
    props: ['modelValue'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

<style scoped>
input {
    border: 2px solid #4C6ED7;
    border-radius: 7px;
    padding: 20px;
    padding-left: 50px;
}
</style>
