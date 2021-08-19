<template>
<app-layout>
    <div class="container">
        <div class="lesson">
            <div class="row flex-column align-items-center p-4">
                <h1 class="blue-text">Lesson 1: Solving Word Problems: Steps & Examples</h1>
                <img style="max-width: 826px; width: 100%" :src="'/images/lesson.png'">
                <button href="" class="blue-button">Quiz</button>
            </div>
        </div>
    </div>
    <div class="notes-section">
        <div class="container">
            <h1 class="blue-text">Notes</h1>
            <div class="notes-section-content d-flex justify-content-center align-items-center flex-column">
                <div class="row d-flex justify-content-center">
                    <p class="w-75">If you’re an auditory learner it may help to use our voice note feature as well as written notes. If you’re a visual learner written notes might be more beneficial for you.</p>
                </div>
                <div class="notes-box row w-75">
                    <div class="col-lg-2 col-12">
                        <div class="row"><div class="notes-circle rounded-circle"><i class="fas fa-microphone-alt"></i></div></div>
                        <div class="row"><div class="notes-circle rounded-circle"><i class="fas fa-flag"></i></div></div>
                        <div class="row"><div class="notes-circle rounded-circle"><i class="fas fa-pen"></i></div></div>
                        <div class="row"><div class="notes-circle rounded-circle"><i class="fas fa-question"></i></div></div>
                    </div>
                    <div class="col-lg-10 col-12 p-4">
                        <h1 class="blue-text">Written Notes</h1>
                        <textarea name="" id="" cols="80" rows="15" placeholder="Notes.."></textarea>
                        <button class="light-button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import Button from "@/Jetstream/Button";

export default {
    components: {
        Button,
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
