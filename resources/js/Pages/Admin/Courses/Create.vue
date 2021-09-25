<template>
    <admin-layout>
        <div class="container">
            <div v-if="$page.props.flash.message" class="alert alert-success">
                {{ $page.props.flash.message }}
            </div>
            <div class="csv-buttons">
                <a href="" class="upload-csv">Upload CSV</a>
                <a href="" class="delete-csv">Delete</a>

                <form
                    class="my-4"
                    enctype="multipart/form-data"
                    action=""
                    @submit.prevent="submit"
                >
                    <input
                        id="csv"
                        class="form-control"
                        type="file"
                        accept=".csv"
                        @input="form.file = $event.target.files[0]"
                    />
                    <input class="my-4" type="submit" value="Submit"/>
                </form>

                <progress
                    style="width: 100%; height: 45px"
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                >
                    {{ form.progress.percentage }}%
                </progress>
                <span
                    style="
                        position: absolute;
                        top: 27.5%;
                        left: 50%;
                        font-size: 12px;
                    "
                    v-if="form.progress"
                >{{ form.progress.percentage }}%</span
                >
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
import AdminLayout from "@/Layouts/AdminLayout";
import {useForm} from "@inertiajs/inertia-vue3";
import {useToast} from "vue-toastification";
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
    setup(props) {
        const toast = useToast();
        const message = computed(() => usePage().props.value.flash.message);
        return {toast, message};
    },
    props: {
        user: Object,
        errors: Object,
        flash: this,
    },
    components: {
        AdminLayout,
    },

    data() {
        return {
            form: {
                file: null,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(route("admin.courses.store"), this.form);
        },
    },
    mounted() {
        // console.log(this.$inertia);
    },
    watch: {
        errors(val, oldVal) {
            console.log("errors");
            console.log(val);
            console.log(oldVal);
            if (val.file !== oldVal.file) {
                this.toast.error(this.errors.file);
                val.file = null
            }
        },
        flash(val, oldVal) {
            console.log("flash");
            console.log(val);
            console.log(oldVal);
            if (val.message !== oldVal.message) {
                this.toast.success(this.flash.message);
                val.message = null
            }
        },
    },
};
</script>
