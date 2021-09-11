<template>
    <admin-layout>
        <div class="container">
            <div class="csv-buttons">
                <a href="" class="upload-csv">Upload CSV</a>
                <a href="" class="delete-csv">Delete</a>
                <form class="my-4" enctype="multipart/form-data" action=""
                      @submit.prevent="form.post(route('admin.courses.store'))">
                    <input id="csv" class="form-control" type="file"
                           @input="form.file = $event.target.files[0]"/>
                    <input class="my-4" type="submit" value="Submit">
                </form>

                <progress style="width: 100%" v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
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
import {useForm} from '@inertiajs/inertia-vue3'

export default {
    setup() {
        const form = useForm({
            file: null,
        })
        return {form}
    },
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
