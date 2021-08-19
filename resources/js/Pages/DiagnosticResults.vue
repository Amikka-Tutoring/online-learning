<template>
    <app-layout>
        <div class="container">
        <div class="results">
            <h1 class="blue-text">Results</h1>
            <div class="results-content pl-5" style="margin-top: 90px">
                <div class="row">
                    <div class="col-lg-4 col-12 d-flex align-items-center justify-content-center">
                        <img :src="'/images/laptop.png'">
                    </div>
                    <div class="col-lg-8 col-12 d-flex align-items-center">
                        <p>Based on your results from your <span class="blue-text">academic diagnostic</span> and <span class="blue-text">personality diagnostic</span> we will create a personalize course for you.  </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="strengths">
            <div class="container">
            <h1 class="blue-text">Strengths</h1>
            <div class="strengths-content pl-5" style="margin-top: 90px">
                <div class="row" style="margin-left: 50px">
                    <ol>
                        <li>
                           Plug-in problems
                        </li>
                        <li>
                            World problems
                        </li>
                        <li>
                            Time management
                        </li>
                        <li>
                            Content
                        </li>
                        <li>
                            Geometry
                        </li>
                    </ol>
                </div>
            </div>
            </div>
        </div>
        <div class="container">
        <div class="weaknesses">
            <h1 class="blue-text">Weaknesses</h1>
            <div class="strengths-content pl-5" style="margin-top: 90px">
                <div class="row" style="margin-left: 50px">
                    <ol>
                        <li>
                            Time management
                        </li>
                        <li>
                            Calculus
                        </li>
                        <li>
                            Time management
                        </li>
                        <li>
                            Algebra 2
                        </li>
                        <li>
                            Math
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        </div>

        <div class="strengths">
            <div class="container">
                <h1 class="blue-text">Our Plan For You</h1>
                <div class="strengths-content pl-5" style="margin-top: 90px">
                    <div class="row" style="margin-left: 50px">
                        <ol>
                            <li>
                                Lesson 1
                            </li>
                            <li>
                                Lesson 2
                            </li>
                            <li>
                                If you want us to build you a full course plan please complete the additional <span class="blue-text">academic diagnostics</span> and <span class="blue-text">personality diagnostics </span>on the home page right now.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center" style="padding: 6rem">
                <button class="blue-button">Next Diagnostic</button>
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
    methods: {

    },

    data() {
        return {

        }
    },
}
</script>
