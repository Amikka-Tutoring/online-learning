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
                        style="color: #83d583"
                        v-if="onsuccess" class="ml-2 bi bi-check-circle-fill" data-aos="zoom-in"
                        data-aos-delay="300"></i><i
                        v-if="onerror" class="ml-2 bi bi-x-circle-fill" data-aos="zoom-in" style="color: #dd6f6f"
                        data-aos-delay="300"></i>
                    </button>
                    <div class="custom-file mt-2 custom-inputs">
                        <input accept=".csv" id="csv" type="file" class="form-control-lg form-control p-0 h-auto"
                               required
                               @input=" form.file=$event.target.files[0]">
                    </div>
                </form>
            </div>
            <div v-if="courses || top_layers || mid_layers || less_layers" class="card row flex-row p-4"
                 style="background: rgba(240, 244, 243, 1)"
                 data-aos="fade-up" data-aos-delay="300">
                <div class="col-md-3">
                    <h5 class="mb-2" v-if="courses">Courses created: <span
                        class="badge badge-primary">{{ courses.length }}</span>
                    </h5>
                    <div class="body" v-for="course in courses">
                        <p><i
                            style="color: #83d583"
                            class="mr-2 bi bi-check-circle-fill" data-aos="zoom-in"
                            data-aos-delay="100"></i> {{ course }}</p>
                    </div>
                    <p v-if="courses.length ==0"><i
                        style="color: #4c6ed7"
                        class="mr-2 bi bi bi-info-circle-fill" data-aos="zoom-in"
                        data-aos-delay="100"></i> No course inserted</p>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-2" v-if="top_layers">Top Layers created: <span
                        class="badge badge-primary">{{ mid_layers.length }}</span></h5>
                    <div class="body" v-for="toplayer in top_layers">
                        <p><i
                            style="color: #83d583"
                            class="mr-2 bi bi-check-circle-fill" data-aos="zoom-in"
                            data-aos-delay="100"></i> {{ toplayer }}</p>
                    </div>
                    <p v-if="top_layers.length ==0"><i
                        style="color: #4c6ed7"
                        class="mr-2 bi bi bi-info-circle-fill" data-aos="zoom-in"
                        data-aos-delay="100"></i> No top layer inserted</p>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-2" v-if="mid_layers">Mid Layers created: <span
                        class="badge badge-primary">{{ mid_layers.length }}</span></h5>
                    <div class="body" v-for="midlayer in mid_layers">
                        <p><i
                            style="color: #83d583"
                            class="mr-2 bi bi-check-circle-fill" data-aos="zoom-in"
                            data-aos-delay="100"></i> {{ midlayer }}</p>
                    </div>
                    <p v-if="mid_layers.length ==0"><i
                        style="color: #4c6ed7"
                        class="mr-2 bi bi bi-info-circle-fill" data-aos="zoom-in"
                        data-aos-delay="100"></i> No mid layer inserted</p>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-2" v-if="less_layers">Lessons created: <span
                        class="badge badge-primary">{{ less_layers.length }}</span></h5>
                    <div class="body" v-for="lesson in less_layers">
                        <p><i
                            style="color: #83d583"
                            class="mr-2 bi bi-check-circle-fill" data-aos="zoom-in"
                            data-aos-delay="100"></i> {{ lesson }}</p>
                    </div>
                    <p v-if="less_layers.length ==0"><i
                        style="color: #4c6ed7"
                        class="mr-2 bi bi bi-info-circle-fill" data-aos="zoom-in"
                        data-aos-delay="100"></i> No lesson inserted</p>
                </div>
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
            onsuccess: false,
            onerror: false,
            courses: null,
            top_layers: null,
            mid_layers: null,
            less_layers: null
        }
    },
    methods: {
        submit() {
            let formData = new FormData();
            formData.append("file", this.form.file);
            this.loading = true
            this.onsuccess = false
            this.onerror = false
            axios.post(route('admin.courses.store'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                        if (response.data.message) {
                            this.toast.success(response.data.message);
                            this.onsuccess = true
                        }

                        if (response.data.error) {
                            this.toast.error(response.data.error)
                            this.onerror = true
                        }
                        this.courses = response.data.courses
                        this.top_layers = response.data.top_layers
                        this.mid_layers = response.data.mid_layers
                        this.less_layers = response.data.less_layers

                    }
                )
                .catch(error => {
                    this.onerror = true
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                }).finally(() => {
                this.loading = false
            });
        },
    }
}
</script>
