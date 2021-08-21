<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text">Notes</h1>
            <div class="notes-buttons">
                <div class="row">
                    <div class="col-lg-4 col-12 text-right buttons">
                        <button><i class="fas fa-plus blue-text mr-2"></i>New</button>
                    </div>
                    <div class="col-lg-8 col-12">
                        <i class="fab fa-searchengin fa-2x blue-text pr-2 search-icon position-absolute"
                           style="padding-left: 20px; padding-top: 10px"></i>
                        <input type="text">
                    </div>
                </div>
                <div class="notes" data-aos="fade-up">
                    <div class="notes-content pl-5" style="margin-top: 90px">
                        <transition name="list">
                            <p v-if="notes" class="question-box text-left">
                            <div class="row">
                                <div class="col-11">
                                    This is where all of your voice and written notes will be saved for all of the
                                    courses that you are taking.
                                </div>
                                <div class="col-1 d-flex align-items-center">
                                    <i v-on:click="notes = !notes" class="fas fa-times red-text"></i>
                                </div>
                            </div>
                            </p>
                        </transition>
                        <div class="row">
                            <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="50" data-aos-once="true">
                                <span class="orange-badge badges">Date</span>
                                <div class="notes-box">
                                    <h1>7/11</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                                <div class="notes-box">
                                    <h1>7/12</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                                <div class="notes-box">
                                    <h1>7/13</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                                <div class="notes-box">
                                    <h1>7/14</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                                <span class="pink-badge badges">SAT</span>
                                <div class="notes-box">
                                    <h1>7/11</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                                <div class="notes-box">
                                    <h1>7/12</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                                <div class="notes-box">
                                    <h1>7/13</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="150" data-aos-once="true">
                                <span class="rose-badge badges">Algebra 1</span>
                                <div class="notes-box">
                                    <h1>7/12</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                                <div class="notes-box">
                                    <h1>7/13</h1>
                                    <div class="row">
                                        <span class="pink-badge badges">SAT</span>
                                        <span class="lightrose-badge badges">Medium</span>
                                        <span class="gray-badge badges">Strategy</span>
                                        <span class="lightblue-badge badges">Lesson</span>
                                    </div>
                                    <h5>Lessons</h5>
                                    <p>Linear equations, Slope Intercept</p>
                                </div>
                            </div>
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
        return {}
    },
}
</script>
