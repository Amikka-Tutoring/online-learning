<template>
    <admin-layout>
        <div class="container">
            <div class="admin-courses">
                <div class="courses" data-aos="fade-up">
                    <h1 class="blue-text">Diagnostics</h1>
                    <div class="courses-content" style="margin-top: 90px">
                        <div class="row">
                            <div v-for="course in coursesApi" class="col-lg-3 col-12" data-aos="fade-up"
                                 data-aos-delay="50"
                                 data-aos-once="true">
                                <div class="input-cards mb-4">
                                    <img class="w-100" :src="'../../images/course-img.png'">
                                    <h4>{{ course.title }}</h4>
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
                                    <a :href="route('academic.diagnostics.create')"><h4>New Course Diagnostic</h4></a>
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

    data() {
        return {
            coursesApi: [
                {
                    title: 'SAT Math Self-Paced',
                },
                {
                    title: 'Algebra 1 Self-Paced',
                },
                {
                    title: 'Algebra 2 Self-Paced',
                },
                {
                    title: 'Pre-Calculus Self-Paced',
                },
                {
                    title: 'SAT Reading Self-Paced'
                },
                {
                    title: 'SAT Grammar Self-Paced'
                }
            ]
        }
    },
}
</script>
