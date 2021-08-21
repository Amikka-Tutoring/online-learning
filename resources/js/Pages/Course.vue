<template>
<app-layout>
    <tools-menu/>
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
    <div class="container">
        <div class="faq">
            <h1 class="blue-text">Student FAQ</h1>
            <div class="faq-section-content d-flex justify-content-center align-items-center flex-column">
                <div class="row d-flex justify-content-center">
                    <p class="w-75">Still confused? Check out the student FAQ’s below with video responses. You can even ask us a question and we’ll respond within 72 hrs.</p>
                </div>
                <div class="recommended-box">
                    <div class="recommended-title">Top Questions</div>
                    <div class="recommended-list">
                        <div class="recommended-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    <h5>Lesson 1 <span class="ml-2 badges lightrose-badge">Medium</span></h5>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <h5>03:23</h5>
                                </div>
                            </div>
                        </div>
                        <div class="recommended-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    <h5>Concision<span class="ml-2 badges gray-badge">Strategy</span><span class="ml-2 badges gray-badge">All</span></h5>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <h5>10:00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="recommended-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    <h5>Intro<span class="ml-2 badges lightblue-badge">Easy</span><span class="ml-2 badges lightrose-badge">Lesson</span></h5>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <h5>01:23</h5>
                                </div>
                            </div>
                        </div>
                        <div class="recommended-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    <h5>Lesson 1<span class="ml-2 badges lightrose-badge">Medium</span></h5>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <h5>03:23</h5>
                                </div>
                            </div>
                        </div>
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
import ToolsMenu from "../components/ToolsMenu";

export default {
    components: {
        Button,
        AppLayout,
        ToolsMenu
    },
    methods: {

    },

    data() {
        return {

        }
    },
}
</script>
