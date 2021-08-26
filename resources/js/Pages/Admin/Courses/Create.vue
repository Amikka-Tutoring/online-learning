<template>
    <admin-layout>
        <div class="container">
            <div class="csv-buttons">
                <a href="" class="upload-csv">Upload CSV</a>
                <a href="" class="delete-csv">Delete</a>
            </div>
            <div class="csv-table">
                <table>
                    <thead>
                    <tr>
                        <th>toplayer_name</th>
                        <th>toplayer_video</th>
                        <th>toplayer_title</th>
                        <th>toplayer_tags</th>
                        <th>question_difficulty_level</th>
                        <th>question_explanation</th>
                        <th>option_a</th>
                        <th>option_b</th>
                        <th>option_c</th>
                        <th>option_d</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="n in 10">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
