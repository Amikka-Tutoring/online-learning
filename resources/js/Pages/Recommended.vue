<template>
    <app-layout>
        <div class="container">
            <div class="recommended" data-aos="fade-up">
                <h1 class="blue-text">Recommended Grammar</h1>
                <div class="recommended-content">
                    <div class="row d-flex justify-content-center">
                        <p>These recommendations are based on a variety of factors including your diagnostic, goal
                            score, time until exam, and progress.</p>
                    </div>
                    <div class="recommended-box">
                        <div class="recommended-title" @click="rec = !rec">
                            <div class="row">
                                <div class="col-10">
                                    Recommended
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

            <div class="grammar-course" data-aos="fade-up">
                <h1 class="blue-text">Full Grammar Course</h1>
                <div class="grammar-course-content">
                    <p>These recommendations are based on a variety of factors including your diagnostic, goal
                        score,
                        time until exam, and progress.</p>
                    <div class="first-list grammar-list w-100" @click="full_course = !full_course">
                        <div class="row">
                            <div class="col-10">
                                Full Course
                            </div>
                            <div class="col-2 text-right">
                                <i v-bind:class="full_course ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                   class="text-white"></i>
                            </div>
                        </div>
                    </div>
                    <collapse-transition>
                        <div v-show="full_course" class="full-course">
                            <div class="second-list grammar-list w-75"
                                 @click="english_strategy = !english_strategy">
                                <div class="row">
                                    <div class="col-10">
                                        English Strategy
                                    </div>
                                    <div class="col-2 text-right">
                                        <i v-bind:class="english_strategy ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                           class="text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <collapse-transition>
                                <div v-if="english_strategy" class="english_strategy">
                                    <div class="third-list grammar-list w-60" @click="concision1 = !concision1">
                                        <div class="row">
                                            <div class="col-10">
                                                Concision
                                            </div>
                                            <div class="col-2 text-right">
                                                <i v-bind:class="concision1 ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                   class="text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <collapse-transition>
                                        <div v-if="concision1" class="concision1">
                                            <div class="recommended-item w-60">
                                                <div class="row">
                                                    <div
                                                        class="col-2 d-flex justify-content-center align-items-center text-center">
                                                        <i class="fas fa-play-circle fa-2x"
                                                           style="color: #4C6ED7"></i>
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
                                            <div class="w-50">
                                                <div class="fourth-list grammar-list"
                                                     @click="wordy_phrases = !wordy_phrases">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            Wordy Phrases
                                                        </div>
                                                        <div class="col-2 text-right">
                                                            <i v-bind:class="wordy_phrases ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                               class="text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <collapse-transition>
                                                    <div v-if="wordy_phrases" class="wordy_phrases">
                                                        <div class="recommended-item">
                                                            <div class="row">
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <i class="fas fa-play-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div class="col-8 d-flex align-items-center">
                                                                    <h5>Concision<span
                                                                        class="ml-2 badges gray-badge">Strategy</span><span
                                                                        class="ml-2 badges gray-badge">All</span>
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
                                                                    <i class="fas fa-play-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div class="col-8 d-flex align-items-center">
                                                                    <h5>Concision<span
                                                                        class="ml-2 badges gray-badge">Strategy</span><span
                                                                        class="ml-2 badges gray-badge">All</span>
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
                                                                    <i class="fas fa-play-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div class="col-8 d-flex align-items-center">
                                                                    <h5>Concision<span
                                                                        class="ml-2 badges gray-badge">Strategy</span><span
                                                                        class="ml-2 badges gray-badge">All</span>
                                                                    </h5>
                                                                </div>
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <h5>03:23</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </collapse-transition>
                                                <div class="fourth-list grammar-list"
                                                     @click="redundancy = !redundancy">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            Redundancy
                                                        </div>
                                                        <div class="col-2 text-right">
                                                            <i v-bind:class="redundancy ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                               class="text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <collapse-transition>
                                                    <div v-if="redundancy" class="redundancy">
                                                        <div class="recommended-item">
                                                            <div class="row">
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <i class="fas fa-play-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div class="col-8 d-flex align-items-center">
                                                                    <h5>Concision<span
                                                                        class="ml-2 badges gray-badge">Strategy</span><span
                                                                        class="ml-2 badges gray-badge">All</span>
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
                                                                    <i class="fas fa-play-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div class="col-8 d-flex align-items-center">
                                                                    <h5>Concision<span
                                                                        class="ml-2 badges gray-badge">Strategy</span><span
                                                                        class="ml-2 badges gray-badge">All</span>
                                                                    </h5>
                                                                </div>
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <h5>03:23</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </collapse-transition>
                                            </div>
                                        </div>
                                    </collapse-transition>

                                    <div class="w-60">
                                        <div class="third-list grammar-list" @click="concision = !concision">
                                            <div class="row">
                                                <div class="col-10">
                                                    Concision
                                                </div>
                                                <div class="col-2 text-right">
                                                    <i v-bind:class="concision ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                       class="text-white"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <collapse-transition>
                                            <div v-show="concision" class="concision">
                                                <div class="recommended-item">
                                                    <div class="row">
                                                        <div
                                                            class="col-2 d-flex justify-content-center align-items-center text-center">
                                                            <i class="fas fa-play-circle fa-2x"
                                                               style="color: #4C6ED7"></i>
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
                                                            <i class="fas fa-play-circle fa-2x"
                                                               style="color: #4C6ED7"></i>
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
                                        </collapse-transition>
                                    </div>
                                </div>
                            </collapse-transition>
                        </div>
                    </collapse-transition>
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
            concision: false,
            redundancy: false,
            wordy_phrases: false,
            concision1: false,
            english_strategy: false,
            full_course: false,
            rec: false,
        }
    },
}
</script>
