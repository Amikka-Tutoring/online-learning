<template>
    <app-layout>
        <div class="container">
            <h1>Results:</h1>
            <ul v-for="result in results">
                <li v-bind:class="result.is_correct ? 'green-text' : 'red-text'">{{ result.title }}
                </li>
            </ul>
            <p>Total score: <strong>{{ score }}%</strong></p>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: {
        results: {},
        score: ''
    },
    methods: {},

    data() {
        return {}
    },
}
</script>
