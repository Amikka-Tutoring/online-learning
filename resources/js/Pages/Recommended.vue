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
                    <template v-for="course in courses">
                        <div class="first-list grammar-list w-100" @click="full_course = !full_course">
                            <div class="row">
                                <div class="col-10">
                                    {{ course.name }}
                                </div>
                                <div class="col-2 text-right">
                                    <i v-bind:class="full_course ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                       class="text-white"></i>
                                </div>
                            </div>
                        </div>
                        <collapse-transition>
                            <div v-show="full_course" class="full-course">
                                <template v-for="topLayer in course.layers">
                                    <div class="second-list grammar-list w-75"
                                         @click="english_strategy = !english_strategy">
                                        <div class="row">
                                            <div class="col-10">
                                                {{ topLayer.name }}
                                            </div>
                                            <div class="col-2 text-right">
                                                <i v-bind:class="english_strategy ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                   class="text-white"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <collapse-transition>
                                        <div v-if="english_strategy" class="english_strategy">
                                            <div v-for="top_videos in topLayer.videos"
                                                 class="recommended-item w-75">
                                                <div class="row">
                                                    <div
                                                        class="col-2 d-flex justify-content-center align-items-center text-center">
                                                        <i class="fas fa-play-circle fa-2x"
                                                           style="color: #4C6ED7"></i>
                                                    </div>
                                                    <div class="col-8 d-flex align-items-center">
                                                        <h5>{{ top_videos.title }}<span
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
                                            <template v-for="midLayer in topLayer.children">
                                                <div class="third-list grammar-list w-60"
                                                     @click="concision1 = !concision1">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            {{ midLayer.name }}
                                                        </div>
                                                        <div class="col-2 text-right">
                                                            <i v-bind:class="concision1 ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                               class="text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <collapse-transition>
                                                    <div v-if="concision1" class="concision1">
                                                        <div v-for="mid_videos in midLayer.videos"
                                                             class="recommended-item w-60">
                                                            <div class="row">
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <i class="fas fa-play-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div class="col-8 d-flex align-items-center">
                                                                    <h5>{{ mid_videos.title }}<span
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
                                                        <div class="w-50">
                                                            <template v-for="lesson in midLayer.children">
                                                                <div class="fourth-list grammar-list"
                                                                     @click="wordy_phrases = !wordy_phrases">
                                                                    <div class="row">
                                                                        <div class="col-10">
                                                                            {{ lesson.name }}
                                                                        </div>
                                                                        <div class="col-2 text-right">
                                                                            <i v-bind:class="wordy_phrases ? 'fas fa-chevron-up': 'fas fa-chevron-down'"
                                                                               class="text-white"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div v-for="less_videos in lesson.videos"
                                                                     class="recommended-item">
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                            <i class="fas fa-play-circle fa-2x"
                                                                               style="color: #4C6ED7"></i>
                                                                        </div>
                                                                        <div class="col-8 d-flex align-items-center">
                                                                            <h5>{{ less_videos.title }}<span
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
                                                            </template>
                                                        </div>
                                                    </div>
                                                </collapse-transition>
                                            </template>
                                        </div>
                                    </collapse-transition>
                                </template>
                            </div>
                        </collapse-transition>
                    </template>
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
    props: ['courses'],

    data() {
        return {
            concision: true,
            redundancy: true,
            wordy_phrases: true,
            concision1: true,
            english_strategy: true,
            full_course: true,
            rec: true,
        }
    },
    mounted(props) {
        console.log(this.courses)
    }
}
</script>
