<template>
    <app-layout>
        <div class="container">
            <div class="calendar" data-aos="fade-up">
                <h1 class="blue-text">Strategic Calendar</h1>
                <div class="calendar-content pl-5 pb-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="calendar" class="question-box text-left">
                        <div class="row">
                            <div class="col-11">
                                Finish building your calendar by clicking “edit schedule” to add practice exams and
                                additional lessons.
                            </div>
                            <div class="col-1 d-flex align-items-center" data-aos="fade-up" data-aos-delay="50"
                                 data-aos-once="true">
                                <i v-on:click="calendar = !calendar" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row justify-content-md-center">
                        <div class="col-lg-3 col-12">
                            <div class="calendar-box mb-4">
                                <div class="row">
                                    <span class="blue-text font-weight-bold">Next Lesson:</span>
                                    <p>Tuesday, 8/3 at 3:00 pm</p>
                                </div>
                                <div class="row">
                                    <span class="blue-text font-weight-bold">Next Practice Exam:</span>
                                    <p>Wednesday, 8/4 at 3:00 pm</p>
                                </div>
                            </div>
                            <a href="" class="blue-text font-weight-bold pt-4">Edit Schedule</a>
                        </div>
                    </div>
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
    methods: {},

    data() {
        return {
            calendar: true,
        }
    },
}
</script>
