<template>
    <button :disabled="loading"
            class="d-flex items-center log-in-btn text-uppercase justify-content-center align-items-center">
        <div v-if="loading" class="spinner-border spinner-border-sm mr-2"/>
        <slot/>
    </button>
</template>
<script>
export default {
    props: {
        loading: Boolean,
    },
}
</script>
