<template>
    <admin-layout>
        <div class="container admin-dashboard">
            <h1 class="blue-text">Dashboard</h1>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="dashboard-boxes">
                            <div class="box-content">
                                <h1>{{ user_count }}</h1>
                                <h3>Active Users</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="dashboard-boxes">
                            <div class="box-content">
                                <h1>19</h1>
                                <h3>New Users</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    components: {
        AdminLayout,
    },
    methods: {},
    props: ['user_count'],

    data() {
        return {}
    },
}
</script>
