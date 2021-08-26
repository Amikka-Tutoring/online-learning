<template>
    <admin-layout>
        <div class="container" data-aos="fade-up">
            <div class="csv-buttons">
                <a href="" class="upload-csv">Upload CSV</a>
                <a href="" class="delete-csv">Delete</a>
            </div>
            <div class="csv-table">
                <table>
                    <thead>
                    <tr>
                        <th>Practice Exam Title</th>
                        <th>URL</th>
                        <th>Subject</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="n in 10">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <!--                            <div class="btn-group">-->
                            <div class="btn btn-primary pt-0 pb-0 mr-2 action-buttons"
                                 style="background-color: #4C6ED7;">Edit
                            </div>
                            <div class="btn btn-danger pt-0 pb-0 action-buttons">Delete</div>
                            <!--                            </div>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
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
    props: ['user'],
    methods: {},

    data() {
        return {}
    },
}
</script>
