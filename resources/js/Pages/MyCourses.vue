<template>
    <app-layout>
        <div class="container">
            <div class="courses" data-aos="fade-up">
                <h1 class="blue-text">My Courses</h1>
                <div class="courses-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="courses" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                These course recommendations are based on a variety of factors including your
                                diagnostic, goal score, time until exam, and progress.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="courses = !courses" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row">
                        <div v-for="user_course in user_courses.enrollments" class="col-lg-3 col-12" data-aos="fade-up"
                             data-aos-delay="50"
                             data-aos-once="true">
                            <a :href="route('course')">
                                <div class="input-cards">
                                    <img class="w-100" :src="'images/course-img.png'">
                                    <h4>{{ user_course.course.name }}</h4>
                                    <div class="row justify-content-center align-items-center"
                                         style="margin-top: 60px; margin-bottom: 10px">
                                        <div class="col-9">
                                            <div class="progress" style="height: 5px; margin-left: 20px">
                                                <div
                                                    style="background: #4C6ED7;"
                                                    v-bind:style="{'width':(user_course.course.quizzes_attempted / user_course.course.quizzes_count)*100 + '%'}"
                                                    class="progress-bar"
                                                    role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="blue-text">{{
                                                    user_course.course.quizzes_attempted
                                                }}/{{
                                                    user_course.course.quizzes_count
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <p>Why should I do this?</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: ['user_courses'],
    methods: {},

    data() {
        return {
            courses: true,
        }
    },
}
</script>
