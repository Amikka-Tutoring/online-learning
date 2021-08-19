<template>
    <app-layout>
        <div class="container">
        <!--            <div  class="d-flex justify-content-center">-->
        <div v-if="form.currentstep != 1 && form.currentstep !=8" class="row justify-content-center align-items-center" style="margin-bottom: 70px">
            <div class="progress" style="height: 5px; width: 370px; margin-right: 20px">
                <div style="background: #56C880;" :style="{width: form.progress_value +'%'}" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="blue-text">Skip</div>
        </div>
        <div v-if="form.errors.length" class="alert alert-danger" v-for="error in form.errors">{{ error }}</div>
        <div>
            <form class="form" method="POST">
                <div v-if="form.currentstep === 1" class="first-step">
                    <h1><span class="blue-text">Math</span> Diagnostic</h1>
                    <div class="row" style="margin-left: 100px">
                        <ol>
                            <li>
                                The <span class="blue-text">academic diagnostic</span> helps us access your <span class="blue-text">strengths and weaknesses </span>in order to <span class="blue-text">maximize your score.</span>
                            </li>
                            <li>
                                Based on your <span class="blue-text">performance</span> we build you a personalized course that teaches you exactly what you need to know.
                            </li>
                            <li>
                                Please answer the next ten questions to the <span class="blue-text">best of your ability.</span>
                            </li>
                            <li>
                                <button v-if="form.currentstep === 1" @click.prevent="next()" class="blue-button">Start</button>
                            </li>

                        </ol>

                    </div>
                </div>
                <div v-if="form.currentstep === 2">
                    <div class="row math-questions">
                        <div class="col-lg-6 col-12">
                            <img :src="'/images/math-question.png'" style="width: 100%">
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="row">
                                <label for="a">A</label>
                                <input type="radio" id="a" v-model="form.question1" value="a">

                                <label for="b">B</label>
                                <input type="radio" id="b" v-model="form.question1" value="b">
                            </div>
                            <div class="row">
                                <label for="c">C</label>
                                <input type="radio" id="c" v-model="form.question1" value="c">
                                <label for="d">D</label>
                                <input type="radio" id="d" v-model="form.question1" value="d">
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="form.currentstep === 3">
                    <div class="row math-questions">
                        <div class="col-lg-6 col-12">
                            <img :src="'/images/math-question.png'" style="width: 100%">
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="row">
                                <label for="a">A</label>
                                <input type="radio" id="a" v-model="form.question2" value="a">

                                <label for="b">B</label>
                                <input type="radio" id="b" v-model="form.question2" value="b">
                            </div>
                            <div class="row">
                                <label for="c">C</label>
                                <input type="radio" id="c" v-model="form.question2" value="c">
                                <label for="d">D</label>
                                <input type="radio" id="d" v-model="form.question2" value="d">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center">
                    <button v-if="form.currentstep!=3 && form.currentstep!=1" @click.prevent="next()" class="blue-button" style="font-size: 24px">Next</button>
                    <button v-if="form.currentstep==3" @click.prevent="submit()" class="blue-button" style="font-size: 24px">Finish</button>
                </div>
            </form>
        </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
    },
    mount() {
        // $("#date").data("DateTimePicker").show();
    },

    data() {
        return {
            currenstep: 1,
        }
    },

    setup () {
        const form = reactive({
            errors:[],
            question1: null,
            question2: null,

            progress_value: 0,
            currentstep: 1,
        })


        function next () {
            console.log(form.currentstep)
            form.currentstep++
            form.errors = []
            console.log(form.currentstep)
            form.progress_value = form.progress_value + 33
            console.log(form.progress_value)
        }

        function submit(){
            form.errors = []
            form.progress_value = 100
            console.log(form)
            Inertia.post('/math-diagnostic', form)
        }
        return {form, submit, next}
    }
}
</script>
