<template>
    <admin-layout>
        <div class="container">
            <div class="admin-courses">
                <div class="courses" data-aos="fade-up">
                    <div class="modal d-block" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="blue-text">Courses</h1>
                    <div class="courses-content" style="margin-top: 90px">
                        <div class="row">
                            <div v-for="course in courses" class="col-lg-3 col-12" data-aos="fade-up"
                                 data-aos-delay="50"
                                 data-aos-once="true">
                                <div class="input-cards mb-4">
                                    <img class="w-100" :src="'../images/course-img.png'">
                                    <h4>{{ course.name }}</h4>
                                    <div class="row justify-content-center align-items-center"
                                         style="margin-top: 60px; margin-bottom: 10px">
                                        <div class="col-9">

                                        </div>
                                        <div class="col-3">
                                            <div class="blue-text course-edit">Edit</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12" data-aos="fade-up" data-aos-once="true">
                                <div class="input-cards mb-4">
                                    <img class="w-100" :src="'../../images/course-img.png'">
                                    <a :href="route('admin.courses.create')"><h4>New Course</h4></a>
                                    <div class="row justify-content-center align-items-center"
                                         style="margin-top: 60px; margin-bottom: 10px">
                                        <div class="col-9">

                                        </div>
                                        <div class="col-3">
                                            <div class="blue-text course-edit"><i class="blue-text fas fa-plus"></i>
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
    methods: {},
    props: ['courses'],

    data() {
        return {}
    },
}
</script>
