<template>
    <admin-layout>
        <div class="container">
            <div v-if="$page.props.flash.message" class="alert alert-success">
                {{ $page.props.flash.message }}
            </div>
            <div class="csv-buttons">
                <form class="my-4" enctype="multipart/form-data" action=""
                      @submit.prevent="submit">
                    <button type="submit" class="upload-csv">Upload CSV <span v-if="loading"
                                                                              class="spinner-border ml-2"
                                                                              style="width: 1.5rem; height: 1.5rem"></span><i
                        v-if="submitted" class="ml-2 bi bi-check-circle-fill" data-aos="zoom-in"
                        data-aos-delay="300"></i>
                    </button>
                    <div class="custom-file mt-2 custom-inputs">
                        <input accept=".csv" id="csv" type="file" class="form-control-lg form-control p-0 h-auto"
                               required
                               @input=" form.file=$event.target.files[0]">
                        <!--                        <input class="my-4" type="submit" value="Submit">-->
                    </div>
                    <!--                    <div class="mb-3 custom-inputs">-->
                    <!--                        <input class="form-control p-0 h-auto" id="formFileSm" type="file">-->
                    <!--                    </div>-->
                </form>
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
import {useToast} from "vue-toastification";
import {computed} from 'vue'
import {usePage} from '@inertiajs/inertia-vue3'

export default {
    props: {
        user: Object,
        errors: Object,
    },
    components: {
        AdminLayout,
    },
    data() {
        return {
            form: {
                file: null
            },
            loading: false,
            submitted: false
        }
    },
    methods: {
        submit() {
            const toast = useToast();
            let formData = new FormData();
            formData.append("file", this.form.file);
            this.loading = true
            axios.post(route('admin.courses.store'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    toast.success(response.data.message);
                    console.log(response.data.inserted)
                    this.submitted = true
                })
                .catch(error => {
                    console.log(error.response.data)
                    Object.values(error.response.data.errors).flat().forEach(element => toast.error(element))
                }).finally(() => {
                this.loading = false
            });
        },
    }
}
</script>
