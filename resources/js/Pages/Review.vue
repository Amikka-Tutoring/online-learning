<template>
    <app-layout>
        <div class="container">
            <div class="container">
                <div class="grammar-course mt-0" data-aos="fade-up" data-aos-once="true">
                    <h1 class="blue-text">Content to review</h1>
                    <div class="grammar-course-content">
                        <p>These recommendations are based on a variety of factors including your diagnostic, goal
                            score,
                            time until exam, and progress.</p>
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

    data() {
        return {
            rec: false,
            review: true
        }
    },
}
</script>

