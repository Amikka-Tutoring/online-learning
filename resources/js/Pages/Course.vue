<template>
    <app-layout>
        <tools-menu/>

        <div class="lesson-container-margin container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item lesson" v-for="(video,index) in lesson.videos"
                         :class="{ 'active' : index === 0 }">
                        <div class=" row flex-column align-items-center p-4">
                            <h1 id="topic">{{ video.title }}</h1>
                            getEmbeddedFram()
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                   data-slide="prev">
                    <span class="bi bi-arrow-left-circle fa-3x" aria-hidden="true" style="color: black"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators"
                   role="button"
                   data-slide="next">
                    <span class="bi bi-arrow-right-circle fa-3x" aria-hidden="true" style="color: black"></span>
                    <span class="sr-only text-black">Next</span>
                </a>
            </div>
            <div class="row justify-content-center" style="margin-bottom: 100px">
                <button href="" class="blue-button">Quiz</button>
            </div>
        </div>
        <div class="notes-section">
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
                                     @click="questions = false; wrritten_notes = true"><i class="fas fa-pen"></i></div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"
                                     @click="questions = true; wrritten_notes = false">
                                    <i class="fas fa-question"></i></div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-12 p-4">
                            <div v-if="wrritten_notes" class="written_notes">
                                <form action="" @submit.prevent="submit">
                                    <h1 class="blue-text">Written Notes</h1>
                                    <textarea v-model="form.note" id="" cols="80" rows="40" name="written_notes"
                                              placeholder="Notes..." required></textarea>
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
import LazyYoutube from "vue-lazytube";


export default {
    props: ['lesson', 'notes', 'flash', 'errors'],

    setup(props) {

        const toast = useToast();
        const message = computed(() => usePage().props.value.flash.message);

        const form = reactive({
            note: props.notes?.written_notes,
            lesson_id: props.lesson.id,
            topic: document.getElementById('topic')?.innerHTML,
        })
        const questionForm = reactive({
            question_text: null,
            lesson_id: props.lesson.id,
        })

        function submit() {
            Inertia.post(route('notes.store'), form)
        }

        function submitQuestion() {
            Inertia.post(route('notes.store.question'), questionForm)
        }

        return {form, questionForm, submit, submitQuestion, toast, message}
    },
    components: {
        Button,
        AppLayout,
        ToolsMenu,
        LazyYoutube,
    },
    methods: {},
    data() {
        return {
            wrritten_notes: true,
            questions: false
        }
    },
    mounted() {
        console.log('video: ' + document.getElementById('topic').innerHTML)
    },
    watch: {
        errors(val, oldVal) {
            console.log("errors");
            console.log(val);
            console.log(oldVal);
            if (val.question_text !== oldVal.question_text) {
                console.log("test" + this.errors.question_text)
                this.toast.error(this.errors.question_text);
                val.question_text = null
            }
        },
        flash(val, oldVal) {
            console.log("flash");
            console.log(val);
            console.log(oldVal);
            if (val.message !== oldVal.message) {
                this.toast.success(this.flash.message);
                val.message = null
            }
        },
    },
}
</script>
