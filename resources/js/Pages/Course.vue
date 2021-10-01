<template>
    <app-layout>
        <tools-menu/>

        <div class="container"
             v-bind:class="[lesson.videos.length ? 'lesson-container-margin' : '']">
            <div v-if=" lesson.videos.length
        " id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
                 data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item lesson" v-for="(video,index) in lesson.videos"
                         :class="{ 'active' : index === 0 }">
                        <div class=" row flex-column align-items-center p-4">
                            <h1 id="topic" ref="title">{{ video.title }}</h1>
                            <iframe id="youtube_id" :src="embed(video.url)"
                                    style="max-width: 826px; width: 100%; height: 500px; margin: 90px 0; border: none">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div v-if="lesson.videos.length > 1">
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                       data-slide="prev">
                        <span class="bi bi-arrow-left-circle fa-3x" aria-hidden="true"
                              style="color: rgba(76, 110, 215, 0.9)"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators"
                       role="button"
                       data-slide="next">
                        <span class="bi bi-arrow-right-circle fa-3x" aria-hidden="true"
                              style="color: rgba(76, 110, 215, 0.9)"></span>
                        <span class="sr-only text-black">Next</span>
                    </a>
                </div>
            </div>
            <div v-if="lesson.questions.length" class="row justify-content-center" style="margin-bottom: 100px">
                <button href="" class="blue-button" @click="quiz(lesson.id)">Quiz
                </button>
            </div>
        </div>
        <div class="notes-section"
             v-bind:class="[(lesson.videos.length || lesson.questions.length )? '' : 'p-0 border-0']">
            <div class="container">
                <h1 class="blue-text">Notes</h1>
                <div class="notes-section-content d-flex justify-content-center align-items-center flex-column">
                    <div class="row d-flex justify-content-center">
                        <p class="w-75">If you’re an auditory learner it may help to use our voice note feature as well
                            as written notes. If you’re a visual learner written notes might be more beneficial for
                            you.</p>
                    </div>
                    <div class="notes-box row w-75">
                        <div class="col-lg-2 col-12">
                            <div class="row">
                                <div class="notes-circle rounded-circle"><i class="fas fa-microphone-alt"></i></div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"><i class="fas fa-flag"></i></div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"
                                     @click="questions = false; written_notes = true"><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"
                                     @click="questions = true; written_notes = false">
                                    <i class="fas fa-question"></i></div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-12 p-4">
                            <div v-if="written_notes" class="written_notes">
                                <form action="" @submit.prevent="submit">
                                    <h1 class="blue-text">Written Notes</h1>
                                    <textarea required v-model="form.note" id="" cols="80" rows="40"
                                              name="written_notes"
                                              placeholder="Notes..."></textarea>
                                    <button class="light-button">Submit</button>
                                </form>
                            </div>
                            <div v-if="questions" class="questions">
                                <form action="" @submit.prevent="submitQuestion">
                                    <h1 class="blue-text">Questions</h1>
                                    <textarea required v-model="questionForm.question_text" cols="80" rows="40"
                                              name="question_text"
                                              placeholder="Question..."></textarea>
                                    <button class="light-button">Submit</button>
                                </form>
                            </div>
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
                        <p class="w-75">Still confused? Check out the student FAQ’s below with video responses. You can
                            even ask us a question and we’ll respond within 72 hrs.</p>
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
                                        <h5>Concision<span class="ml-2 badges gray-badge">Strategy</span><span
                                            class="ml-2 badges gray-badge">All</span></h5>
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
                                        <h5>Intro<span class="ml-2 badges lightblue-badge">Easy</span><span
                                            class="ml-2 badges lightrose-badge">Lesson</span></h5>
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
import {computed, reactive} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {useToast} from "vue-toastification";
import {usePage} from "@inertiajs/inertia-vue3";


export default {
    props: ['lesson', 'notes', 'flash', 'errors'],

    setup(props) {
        const toast = useToast();
        const message = computed(() => usePage().props.value.flash.message);

        const form = reactive({
            note: props.notes?.written_notes,
            video_id: props.lesson.video.id,
            topic: null,
        })
        const questionForm = reactive({
            question_text: null,
            video_id: props.lesson.video.id,
        })

        function submit() {
            axios.post(route('notes.store'), form)
                .then(response => {
                    toast.success(response.data)
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => toast.error(element))
                });
        }

        function submitQuestion() {
            axios.post(route('notes.store.question'), questionForm)
                .then(response => {
                    toast.success(response.data)
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => toast.error(element))
                });
        }

        return {form, questionForm, submit, submitQuestion, toast, message}
    },
    components: {
        Button,
        AppLayout,
        ToolsMenu,
    },
    methods: {
        embed: function (str) {
            let res = str.split("=");
            let embeddedUrl = "https://www.youtube.com/embed/" + res[1];
            return embeddedUrl;
        },
        quiz: function (lesson_id) {
            Inertia.get(route('lesson.quiz', lesson_id))
        }
    },
    data() {
        return {
            written_notes: true,
            questions: false,
        }
    },
}
</script>
