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
            <div class="grammar-course" data-aos="fade-up" v-for="course in courses">
                <h1 class="blue-text">Full {{ course.name }} Course</h1>
                <div class="grammar-course-content">
                    <p>These recommendations are based on a variety of factors including your diagnostic, goal
                        score,
                        time until exam, and progress.</p>
                    <div class="first-list grammar-list w-100" @click="hide(course.id)">
                        <div class="row">
                            <div class="col-10">
                                {{ course.name }}
                            </div>
                            <div class="col-2 text-right" v-if="course.layers.length">
                                <i :class="'course-icon-'+course.id" class="fas fa-chevron-down text-white"></i>
                            </div>
                        </div>
                    </div>
                    <collapse-transition>
                        <div class="d-none" :class="'full-course-' +course.id">
                            <template v-for="topLayer in course.layers">
                                <div class="second-list grammar-list w-75"
                                     @click="hideTop(topLayer.id)">
                                    <div class="row">
                                        <div class="col-10">
                                            <a :href="route('lesson',topLayer.id)">{{ topLayer.name }}</a>
                                        </div>
                                        <div class="col-2 text-right"
                                             v-if="topLayer.children.length || topLayer.videos.length">
                                            <i :class="'top-icon-'+topLayer.id"
                                               class="fas fa-chevron-down text-white"></i>
                                        </div>
                                    </div>
                                </div>

                                <collapse-transition>
                                    <div class="d-none" :class="'toplayer-' +topLayer.id">
                                        <div v-for="top_videos in topLayer.videos"
                                             class="recommended-item w-75">
                                            <div class="row">
                                                <div
                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                    <a :href="top_videos.url"
                                                       target="_blank">
                                                        <i class="fas fa-play-circle fa-2x"
                                                           style="color: #4C6ED7"></i>
                                                    </a>
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
                                                 @click="hideMid(midLayer.id)">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <a :href="route('lesson',midLayer.id)">{{
                                                                midLayer.name
                                                            }}</a>
                                                    </div>
                                                    <div class="col-2 text-right"
                                                         v-if="midLayer.children.length || midLayer.videos.length">
                                                        <i :class="'mid-icon-'+midLayer.id"
                                                           class="fas fa-chevron-down text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <collapse-transition>
                                                <div class="d-none" :class="'midlayer-' +midLayer.id">
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
                                                                 @click="hideLess(lesson.id)">
                                                                <div class="row">
                                                                    <div class="col-10">
                                                                        <a :href="route('lesson',lesson.id)">
                                                                            {{ lesson.name }}</a>
                                                                    </div>
                                                                    <div class="col-2 text-right"
                                                                         v-if="lesson.videos.length">
                                                                        <i :class="'less-icon-'+lesson.id"
                                                                           class="fas fa-chevron-down text-white"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-none" :class="'lesson-' +lesson.id">
                                                                <div v-for="less_videos in lesson.videos"
                                                                     class="recommended-item">
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                            <i class="fas fa-play-circle fa-2x"
                                                                               style="color: #4C6ED7"></i>
                                                                        </div>
                                                                        <div
                                                                            class="col-8 d-flex align-items-center">
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
    methods: {
        hide(value) {
            $('.full-course-' + value).toggleClass('d-none', 'd-block')
            $('.course-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        },
        hideTop(value) {
            $('.toplayer-' + value).toggleClass('d-none', 'd-block')
            $('.top-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        },
        hideMid(value) {
            $('.midlayer-' + value).toggleClass('d-none', 'd-block')
            $('.mid-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        },
        hideLess(value) {
            $('.lesson-' + value).toggleClass('d-none', 'd-block')
            $('.less-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        }
    },
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
