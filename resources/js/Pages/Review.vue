<template>
    <app-layout>
        <div class="container">
            <div class="recommended" data-aos="fade-up">
                <h1 class="blue-text">Content To Review</h1>
                <div class="recommended-content">
                    <div class="row d-flex justify-content-center">
                        <transition name="list">
                            <p v-if="review" class="question-box text-left">
                            <div class="row">
                                <div class="col-11">
                                    These are the topics that you should review based on lack of completion, lower than
                                    average quiz scores, and flagged questions.
                                </div>
                                <div class="col-1 d-flex align-items-center">
                                    <i v-on:click="review = !review" class="fas fa-times red-text"></i>
                                </div>
                            </div>
                            </p>
                        </transition>
                    </div>
                    <div class="recommended-box">
                        <div class="recommended-title" @click="rec = !rec">
                            <div class="row">
                                <div class="col-10">
                                    Review
                                </div>
                                <div class="col-2 text-right">
                                    <i v-bind:class="rec ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                       class="text-white"></i>
                                </div>
                            </div>
                        </div>
                        <collapse-transition>
                            <div v-show="rec" class="rec">
                                <div class="recommended-list">
                                    <div class="recommended-item">
                                        <div class="row">
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <h5>Intro <span class="badges lightblue-badge">Easy</span><span
                                                    class="badges lightblue-badge">Lesson</span></h5>
                                            </div>
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <h5>01:23</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recommended-item">
                                        <div class="row">
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <h5>Lesson 1 <span class="ml-2 badges lightrose-badge">Medium</span>
                                                </h5>
                                            </div>
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <h5>03:23</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recommended-item">
                                        <div class="row">
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <h5>Concision<span
                                                    class="ml-2 badges gray-badge">Strategy</span><span
                                                    class="ml-2 badges gray-badge">All</span></h5>
                                            </div>
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <h5>03:23</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recommended-item">
                                        <div class="row">
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <h5>Concision<span
                                                    class="ml-2 badges gray-badge">Strategy</span><span
                                                    class="ml-2 badges gray-badge">All</span></h5>
                                            </div>
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <h5>03:23</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recommended-item">
                                        <div class="row">
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <h5>Concision<span
                                                    class="ml-2 badges gray-badge">Strategy</span><span
                                                    class="ml-2 badges gray-badge">All</span></h5>
                                            </div>
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <h5>03:23</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recommended-item">
                                        <div class="row">
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <h5>Concision<span
                                                    class="ml-2 badges gray-badge">Strategy</span><span
                                                    class="ml-2 badges gray-badge">All</span></h5>
                                            </div>
                                            <div
                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                <h5>03:23</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </collapse-transition>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import CollapseTransition from '@ivanv/vue-collapse-transition/src'

export default {
    components: {
        AppLayout,
        CollapseTransition
    },
    methods: {},

    data() {
        return {
            rec: false,
            review: true
        }
    },
}
</script>

