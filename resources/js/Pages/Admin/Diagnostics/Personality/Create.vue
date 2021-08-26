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
                        <th>diagnostic_name</th>
                        <th>question_number</th>
                        <th>question</th>
                        <th>category</th>
                        <th>answer_a</th>
                        <th>answer_b</th>
                        <th>answer_c</th>
                        <th>answer_d</th>
                        <th>answer_e</th>
                        <th>answer_f</th>
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
