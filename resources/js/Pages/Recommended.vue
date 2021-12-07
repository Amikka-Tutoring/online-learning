<template>
    <app-layout>
        <div class="container">
            <div class="grammar-course mt-0" data-aos="fade-up" data-aos-once="true">
                <h1 class="blue-text">Recommended</h1>
                <div class="grammar-course-content">
                    <transition name="list">
                        <div v-if="recommended" class="question-box text-left">
                            <div class="row">
                                <div class="col-lg-11 col-10">
                                    These recommendations are based on a variety of factors including your diagnostic,
                                    goal
                                    score,
                                    time until exam, and progress.
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center">
                                    <i v-on:click="recommended = disableNotification('recommended')"
                                       class="fas fa-times red-text"></i>
                                </div>
                            </div>
                        </div>
                    </transition>
                    <div v-for="top_videos in videos"
                         class="recommended-item">
                        <a :href="route('lesson',top_videos.id)">
                            <div class="row">
                                <div
                                    class="col-2 d-flex justify-content-center align-items-center text-center">

                                    <i v-if="top_videos.viewed" class="bi bi-check-circle-fill fa-2x"
                                       style="color: #4C6ED7"></i>
                                    <i v-else
                                       class="far fa-circle fa-2x"
                                       style="color: #4C6ED7"></i>
                                </div>
                                <div
                                    class="col-8 d-flex align-items-center justify-content-between">
                                    <h5>{{ top_videos.title }}</h5>
                                    <div><span v-for="tag in top_videos.tags"
                                               class="ml-2 badges lightblue-badge">{{
                                            tag.name
                                        }}</span>
                                    </div>
                                </div>
                                <div
                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <h5>{{
                                            moment.duration(top_videos.duration,
                                                'seconds').format("hh:mm:ss")
                                        }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div :id="course.name" class="grammar-course"
                 v-for="course in courses">
                <h1 class="blue-text">Full {{ course.name }} Course</h1>
                <div class="grammar-course-content">
                    <!--                    <p>These recommendations are based on a variety of factors including your diagnostic, goal-->
                    <!--                        score,-->
                    <!--                        time until exam, and progress.</p>-->
                    <div class="first-list grammar-list w-100" @click="hide(course.id)">
                        <div class="row">
                            <div class="col-10">
                                {{ course.name }}
                            </div>
                            <div class="col-2 text-right" v-if="course.layers.length">
                                <i :class="'course-icon-'+course.id" class="fas fa-chevron-up text-white"></i>
                            </div>
                        </div>
                    </div>
                    <collapse-transition>
                        <div :class="'full-course-' +course.id">
                            <template v-for="topLayer in course.layers">
                                <div class="second-list grammar-list w-75"
                                     @click="hideTop(topLayer.id)">
                                    <div class="row">
                                        <div class="col-10">
                                            <span>{{ topLayer.name }}</span>
                                        </div>
                                        <div class="col-2 text-right"
                                             v-if="topLayer.children.length || topLayer.videos.length">
                                            <i :class="'top-icon-'+topLayer.id"
                                               class="fas fa-chevron-up text-white"></i>
                                        </div>
                                    </div>
                                </div>

                                <collapse-transition>
                                    <div :class="'toplayer-' +topLayer.id">
                                        <div v-for="top_videos in topLayer.videos"
                                             class="recommended-item w-75">
                                            <a :href="route('lesson',top_videos.id)">
                                                <div class="row">
                                                    <div
                                                        class="col-2 d-flex justify-content-center align-items-center text-center">

                                                        <i v-if="top_videos.viewed"
                                                           class="bi bi-check-circle-fill fa-2x"
                                                           style="color: #4C6ED7"></i>
                                                        <i v-else
                                                           class="far fa-circle fa-2x"
                                                           style="color: #4C6ED7"></i>
                                                    </div>
                                                    <div
                                                        class="col-8 d-flex align-items-center justify-content-between">
                                                        <h5>{{ top_videos.title }}</h5>
                                                        <div><span v-for="tag in top_videos.tags"
                                                                   class="ml-2 badges lightblue-badge">{{
                                                                tag.name
                                                            }}</span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-2 d-flex justify-content-center align-items-center text-center">
                                                        <h5>{{
                                                                moment.duration(top_videos.duration,
                                                                    'seconds').format("hh:mm:ss")
                                                            }}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <template v-for="midLayer in topLayer.children">
                                            <div class="third-list grammar-list w-60"
                                                 @click="hideMid(midLayer.id)">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <span>{{ midLayer.name }}</span>
                                                    </div>
                                                    <div class="col-2 text-right"
                                                         v-if="midLayer.children.length || midLayer.videos.length">
                                                        <i :class="'mid-icon-'+midLayer.id"
                                                           class="fas fa-chevron-up text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <collapse-transition>
                                                <div :class="'midlayer-' +midLayer.id">
                                                    <div v-for="mid_videos in midLayer.videos"
                                                         class="recommended-item w-60">
                                                        <a :href="route('lesson',mid_videos.id)">
                                                            <div class="row">
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <i v-if="mid_videos.viewed"
                                                                       class="bi bi-check-circle-fill fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                    <i v-else
                                                                       class="far fa-circle fa-2x"
                                                                       style="color: #4C6ED7"></i>
                                                                </div>
                                                                <div
                                                                    class="col-8 d-flex align-items-center justify-content-between">
                                                                    <h5>{{ mid_videos.title }}</h5>
                                                                    <div><span v-for="tag in mid_videos.tags"
                                                                               class="ml-2 badges lightblue-badge">{{
                                                                            tag.name
                                                                        }}</span>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                    <h5>{{
                                                                            moment.duration(mid_videos.duration,
                                                                                'seconds').format("hh:mm:ss")
                                                                        }}</h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="w-50">
                                                        <template v-for="lesson in midLayer.children">
                                                            <div class="fourth-list grammar-list"
                                                                 @click="hideLess(lesson.id)">
                                                                <div class="row">
                                                                    <div class="col-10">
                                                                        <span>{{ lesson.name }}</span>
                                                                    </div>
                                                                    <div class="col-2 text-right"
                                                                         v-if="lesson.videos.length">
                                                                        <i :class="'less-icon-'+lesson.id"
                                                                           class="fas fa-chevron-up text-white"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div :class="'lesson-' +lesson.id">
                                                                <div v-for="less_videos in lesson.videos"
                                                                     class="recommended-item">
                                                                    <a :href="route('lesson',less_videos.id)">
                                                                        <div class="row">
                                                                            <div
                                                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                                <i v-if="less_videos.viewed"
                                                                                   class="bi bi-check-circle-fill fa-2x"
                                                                                   style="color: #4C6ED7"></i>
                                                                                <i v-else
                                                                                   class="far fa-circle fa-2x"
                                                                                   style="color: #4C6ED7"></i>
                                                                            </div>
                                                                            <div
                                                                                class="col-8 d-flex align-items-center justify-content-between">
                                                                                <h5>{{ less_videos.title }}</h5>
                                                                                <div><span
                                                                                    v-for="tag in less_videos.tags"
                                                                                    class="ml-2 badges lightblue-badge">{{
                                                                                        tag.name
                                                                                    }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-2 d-flex justify-content-center align-items-center text-center">
                                                                                <h5>{{
                                                                                        moment.duration(less_videos.duration,
                                                                                            'seconds').format("hh:mm:ss")
                                                                                    }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </a>
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
import moment from "moment";
import 'moment-duration-format';

export default {
    components: {
        AppLayout,
        CollapseTransition
    },
    methods: {
        disableNotification(attribute) {
            localStorage.setItem(attribute, false);
        },
        hide(value) {
            $('.full-course-' + value).toggleClass('d-none')
            $('.course-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },
        hideTop(value) {
            $('.toplayer-' + value).toggleClass('d-none')
            $('.top-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },
        hideMid(value) {
            $('.midlayer-' + value).toggleClass('d-none')
            $('.mid-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },
        hideLess(value) {
            $('.lesson-' + value).toggleClass('d-none')
            $('.less-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },


        hideRec(value) {
            $('.rec-full-course-' + value).toggleClass('d-none')
            $('.rec-course-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },
        hideTopRec(value) {
            $('.rec-toplayer-' + value).toggleClass('d-none')
            $('.rec-top-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },
        hideMidRec(value) {
            $('.rec-midlayer-' + value).toggleClass('d-none')
            $('.-rec-mid-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        },
        hideLessRec(value) {
            $('.rec-lesson-' + value).toggleClass('d-none')
            $('.rec-less-icon-' + value).toggleClass('fa-chevron-up fa-chevron-down')
        }
    },
    props: ['courses', 'videos'],
    setup() {
        let saved = localStorage.getItem('recommended') === null;
        if (saved) {
            localStorage.setItem('recommended', true)
        }
    },

    data() {
        return {
            moment: moment,
            concision: true,
            redundancy: true,
            wordy_phrases: true,
            concision1: true,
            english_strategy: true,
            full_course: true,
            rec: true,
            recommended: localStorage.getItem('recommended') === 'true',
        }
    },
    mounted() {
    }
}
</script>

<style scoped>
a:hover {
    text-decoration: none;
}
</style>
