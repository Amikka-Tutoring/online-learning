<template>
    <Head :title="title" />
    <h1>Test</h1>

</template>


<script>

import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        title: String,
    },

    components: {
        Head,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },
    }
}
</script>

