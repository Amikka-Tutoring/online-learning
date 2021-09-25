<template>
    <app-layout>
        <div class="results-wrapper">
            <div class="container">
                <div class="row result">
                    <div class="col-md-7 align-self-center">
                        <div class="text">
                            <h1 class="blue-text" style="margin-top: 0">Results</h1>
                            <p>Based on your results from your <strong>academic diagnostic</strong>
                                and
                                <strong>personality diagnostic</strong> we will create a personalize
                                course for you.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img :src="'../images/results-image.png'"
                             style="position:absolute; height: 710px; top:43%; right: 0">
                    </div>
                </div>
            </div>
            <div class="strengths-weakness result d-flex align-items-center" style="height: 650px">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="title-mb">Strengths</h4>
                                    <ol>
                                        <li>Plug-in problems</li>
                                        <li>Word problems</li>
                                        <li>Time management</li>
                                        <li>Content</li>
                                        <li>Geometry</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="title-mb">Weaknesses</h4>
                                    <ol>
                                        <li>Time management</li>
                                        <li>Calculus</li>
                                        <li>Time management</li>
                                        <li>Algebra 2</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">

                        </div>
                    </div>
                </div>
            </div>
            <div class="plan">
                <div class="container">
                    <h1 class="blue-text">Our Plan For You</h1>
                    <ol>
                        <li>Plug-in problems</li>
                        <li>Word problems</li>
                        <li>Time management</li>
                    </ol>
                </div>
            </div>
            <div class="strengths-weakness result d-flex align-items-center" style="height: auto">
                <div class="container">
                    <h1 class="blue-text">Results</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="">Corrects</h4>
                            <ol>
                                <li v-for="result in results" v-bind:class=" result.is_correct ?
                            'green-text' : 'red-text'">{{ result.title }}
                                </li>
                                <li>Total score: <strong class="blue-text">{{ score }}%</strong></li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h4 class="">Wrongs</h4>
                            <ol>
                                <li v-for="result in results" v-bind:class=" result.is_correct ?
                            'green-text' : 'red-text'">{{ result.title }}
                                </li>
                                <li>Total score: <strong class="blue-text">{{ score }}%</strong></li>
                            </ol>
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
    props: {
        results: {},
        score: ''
    },

    data() {
        return {}
    },
}
</script>
