<template>
    <h1>Test</h1>
    <Link :href="route('dashboard')">Link</Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        title: String,
    },

    components: {
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
    },
};
</script>
