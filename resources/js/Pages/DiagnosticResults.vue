<template>
    <app-layout>
        <div class="results-wrapper">
            <div class="container">
                <div class="row result">
                    <div class="col-md-7 align-self-center">
                        <div class="text">
                            <h1 class="blue-text" style="margin-top: 0">Results</h1>
                            <p>{{ this.results.summary }}</p>
                            <a :href="route('dashboard')"
                               style="font-size: 1rem; color: white; padding: 5px 40px; background: #4c6ed7; border-radius: 5px">Next</a>
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
                    <h1 class="blue-text">What We've Learned</h1>
                    <ol>
                        <li v-for="l in learned">{{ l }}</li>
                    </ol>
                </div>
            </div>
            <div class="plan position-relative">
                <div class="container">
                    <h1 class="blue-text">Our Plan For You</h1>
                    <ol>
                        <li v-for="p in this.plan">{{ p }}</li>
                    </ol>
                </div>
            </div>
            <div v-if="tips" class="strengths-weakness result d-flex align-items-center" style="height: 650px">
                <div class="container">
                    <h1 class="blue-text">Tips To Learn Better</h1>
                    <ol>
                        <li v-for="t in tips">{{ t }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin:0px">
            <div class="col-md-3 d-flex">
                <a :href="route('dashboard')"
                   style="font-size: 1rem; color: white; padding: 5px 20px; background: #4c6ed7; border-radius: 5px; width: 100%; text-align: center">Next</a>
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
    props: ['results', 'plan', 'learned', 'tips'],

    data() {
        return {
            results: this.results,
            plan: this.plan,
            learned: this.learned
        }
    },
    mounted() {
        console.log(this.results)
        console.log(this.plan)
        console.log(this.learned)
    }
}
</script>
