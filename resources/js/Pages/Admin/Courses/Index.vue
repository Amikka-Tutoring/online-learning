$query
<template>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control"
                               v-model="form.name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="deleteCourse(form)">Delete
                        <span
                            v-if="deleteLoader"
                            class="spinner-border ml-2"
                            style="width: 1rem; height: 1rem"></span></button>
                    <button type="button" class="btn btn-primary" @click="update(form)">Update <span
                        v-if="loading"
                        class="spinner-border ml-2"
                        style="width: 1rem; height: 1rem"></span></button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            @click="closeModal()">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <admin-layout>
        <div class="container">
            <div class="admin-courses">
                <div class="courses" data-aos="fade-up">
                    <h1 class="blue-text">Courses</h1>
                    <div class="courses-content" style="margin-top: 90px">
                        <div class="row">
                            <div v-for="course in courses" class="col-lg-3 col-md-6" data-aos="fade-up"
                                 data-aos-delay="50"
                                 data-aos-once="true">
                                <div class="input-cards mb-4">
                                    <img class="w-100" :src="'../images/course-img.png'">
                                    <h4 :id="course.id">{{ course.name }}</h4>
                                    <div class="row justify-content-center align-items-center mx-0"
                                         style="margin-top: 60px; margin-bottom: 10px">
                                        <div class="col-lg-9 col-7">

                                        </div>
                                        <div class="col-lg-3 col-5">
                                            <div class="blue-text course-edit" @click="edit(course)" data-toggle="modal"
                                                 data-target="#modal">Edit
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6" data-aos="fade-up"
                                 data-aos-delay="50"
                                 data-aos-once="true">
                                <div class="input-cards mb-4">
                                    <img class="w-100" :src="'../../images/course-img.png'">
                                    <a :href="route('admin.courses.create')"><h4>New Course</h4></a>
                                    <div class="row justify-content-center align-items-center"
                                         style="margin-top: 60px; margin-bottom: 10px">
                                        <div class="col-9">

                                        </div>
                                        <div class="col-3">
                                            <div class="blue-text course-edit"><a :href="route('admin.courses.create')"><i
                                                class="blue-text fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    props: ['courses'],
    methods: {
        openModal: function () {
            this.isOpen = true;
        },
        closeModal: function () {
            $('#modal').modal('hide');
            this.isOpen = false;
            this.reset();
        },
        reset: function () {
            this.form = {
                name: null,
                id: null
            }
            this.editMode = false;
            this.loading = false;
            this.deleteLoader = false;
        },
        edit: function (data) {
            this.form.name = data.name
            this.form.id = data.id
            this.editMode = true;
            this.openModal();
        },
        update: function (data) {
            this.loading = true
            axios.put(route('course.update', data.id), data)
                .then(response => {
                    this.getCourses();
                    this.toast.success(response.data.message);
                    this.loading = false
                    this.closeModal();
                    this.reset();
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                    this.loading = false
                });
        },
        deleteCourse: function (data) {
            if (!confirm('Are you sure want to remove?')) return;
            this.deleteLoader = true
            axios.delete(route('course.delete', data.id))
                .then(response => {
                    this.getCourses();
                    this.toast.success(response.data.message);
                    this.deleteLoader = false
                    this.closeModal();
                    this.reset();
                })
                .catch(error => {
                        Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                        this.deleteLoader = false
                    }
                );
        },
        getCourses: function () {
            axios.get(route('courses.get')).then(response => {
                this.courses = response.data
                this.loadingCourses = false
            })
        }
    },
    data() {
        return {
            editMode: false,
            form: {
                name: null,
            },
            isOpen: false,
            loading: false,
            courses: this.courses,
            loadingCourses: true,
            deleteLoader: false
        }
    },
    mounted() {
        // this.getCourses()
    }
}
</script>
