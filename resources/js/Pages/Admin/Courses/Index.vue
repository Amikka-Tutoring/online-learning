<template>
    <admin-layout>
        <div class="container">
            <div class="admin-courses">
                <div class="courses" data-aos="fade-up">
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
