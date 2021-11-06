<template>
    <app-layout>
        <div class="container">
            <div class="container">
                <div class="grammar-course mt-0" data-aos="fade-up" data-aos-once="true">
                    <h1 class="blue-text">Content to review</h1>
                    <div class="grammar-course-content">
                        <transition name="list">
                            <div v-if="review_box" class="question-box text-left">
                                <div class="row">
                                    <div class="col-lg-11 col-10">
                                        These recommendations are based on a variety of factors including your
                                        diagnostic,
                                        goal
                                        score,
                                        time until exam, and progress.
                                    </div>
                                    <div class="col-lg-1 col-2 d-flex align-items-center">
                                        <i v-on:click="review_box = disableNotification('review_box')"
                                           class="fas fa-times red-text"></i>
                                    </div>
                                </div>
                            </div>
                        </transition>
                        <template v-for="course in courses_to_review">
                            <div class="first-list grammar-list w-100">
                                <div class="row" @click="hideRec(course.id)">
                                    <div class="col-10">
                                        {{ course.name }}
                                    </div>
                                    <div class="col-2 text-right" v-if="course.layers.length">
                                        <i :class="'rec-course-icon-'+course.id"
                                           class="fas fa-chevron-down text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <collapse-transition>
                                <div class="d-none" :class="'rec-full-course-' +course.id">
                                    <template v-for="topLayer in course.layers">
                                        <div class="second-list grammar-list w-75"
                                             @click="hideTopRec(topLayer.id)">
                                            <div class="row">
                                                <div class="col-12">
                                                    <a :href="route('lesson',topLayer.id)">{{ topLayer.name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </collapse-transition>
                        </template>
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
    props: ['courses_to_review'],
    methods: {

        disableNotification(attribute) {
            localStorage.setItem(attribute, false);
        },
        hideRec(value) {
            $('.rec-full-course-' + value).toggleClass('d-none', 'd-block')
            $('.rec-course-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        },
        hideTopRec(value) {
            $('.rec-toplayer-' + value).toggleClass('d-none', 'd-block')
            $('.rec-top-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        },
        hideMidRec(value) {
            $('.rec-midlayer-' + value).toggleClass('d-none', 'd-block')
            $('.-rec-mid-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        },
        hideLessRec(value) {
            $('.rec-lesson-' + value).toggleClass('d-none', 'd-block')
            $('.rec-less-icon-' + value).toggleClass('fa-chevron-up', 'fa-chevron-down')
        }
    },
    setup() {
        let saved = localStorage.getItem('review_box') === null;
        if (saved) {
            localStorage.setItem('review_box', true)
        }
    },

    data() {
        return {
            rec: false,
            review: true,
            review_box: localStorage.getItem('review_box') === 'true',
        }
    },
}
</script>

