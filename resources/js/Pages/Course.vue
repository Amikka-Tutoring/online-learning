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
                <button class="blue-button" @click="quiz(lesson.id)" v-if="user_attempt === 0">Quiz
                </button>
                <button class="blue-button" v-if="user_attempt !== 0"
                        disabled="">Quiz Completed <i class="ml-2 bi bi-check-circle-fill"
                                                      style="color: rgb(131, 213, 131);"></i>
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
                                <div class="notes-circle rounded-circle"
                                     @click="audio = true; questions = false; written= false"><i
                                    class="fas fa-microphone-alt"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"><i class="fas fa-flag"></i></div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"
                                     @click="questions = false; written = true; audio= false"><i class="fas fa-pen"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="notes-circle rounded-circle"
                                     @click="questions = true; written = false; audio = false">
                                    <i class="fas fa-question"></i></div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-12 p-4">
                            <div v-if="written" class="written_notes">
                                <form action="" @submit.prevent="submit">
                                    <h1 class="blue-text">Written Notes</h1>
                                    <textarea required v-model="form.written_notes" id="" cols="80" rows="40"
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
                            <div v-show="audio" @click="recorder"
                                 class="audio h-100" style="margin-top: 30%">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="w-50 d-flex flex-column align-items-center mb-4">
                                        <button v-show="started" id="btnStop" class="border-0 bg-transparent"
                                                @click="stopped = true; started = false"><i
                                            class="fas fa-microphone-alt blue-text fa-2x"></i>
                                        </button>
                                        <button v-show="stopped" id="btnStart" class="bg-transparent  border-0"
                                                @click="started = true; stopped=false"><i
                                            class="fas fa-microphone-alt blue-text fa-2x"></i>
                                        </button>
                                        <div v-if="started" class="spinner-grow text-danger" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <audio id="adioPlay" controls></audio>
                                </div>
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
import {Inertia} from '@inertiajs/inertia'


export default {
    props: ['lesson', 'notes', 'user', 'user_attempt'],

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
        },
        submit: function () {
            axios.post(route('notes.store'), this.form)
                .then(response => {
                    this.toast.success(response.data.message)
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        submitQuestion: function () {
            axios.post(route('notes.store.question'), this.questionForm)
                .then(response => {
                    this.toast.success(response.data)
                    this.questionForm.question_text = null
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
    },
    data() {
        return {
            written: true,
            questions: false,
            audio: false,
            stopped: true,
            started: false,
            form: {
                written_notes: this.notes?.written_notes,
                layer_id: this.lesson.id,
                audio_notes: '',
                topic: null,
            },
            questionForm: {
                question_text: null,
                lesson_id: this.lesson.id,
            }
        }
    },
    mounted() {
        let audioIN = {audio: true};

        let parentForm = this.form
        let parentThis = this

        navigator.mediaDevices.getUserMedia(audioIN)
            // 'then()' method returns a Promise
            .then(function (mediaStreamObj) {


                    // Start record
                    let start = document.getElementById('btnStart');

                    // Stop record
                    let stop = document.getElementById('btnStop');

                    // 2nd audio tag for play the audio
                    let playAudio = document.getElementById('adioPlay');

                    // This is the main thing to recorde
                    // the audio 'MediaRecorder' API
                    let mediaRecorder = new MediaRecorder(mediaStreamObj);
                    // Pass the audio stream

                    // Start event
                    start.addEventListener('click', function (ev) {
                        mediaRecorder.start();
                        // console.log(mediaRecorder.state);
                    })

                    // Stop event
                    stop.addEventListener('click', function (ev) {
                        mediaRecorder.stop();
                        // console.log(mediaRecorder.state);
                    });

                    // If audio data available then push
                    // it to the chunk array
                    mediaRecorder.ondataavailable = function (ev) {
                        dataArray.push(ev.data);
                    }

                    // Chunk array to store the audio data
                    let dataArray = [];


                    // Convert the audio data in to blob
                    // after stopping the recording
                    mediaRecorder.onstop = function (ev) {

                        // blob of type mp3
                        let audioData = new Blob(dataArray,
                            {'type': 'audio/mp3;'});

                        // After fill up the chunk
                        // array make it empty
                        dataArray = [];

                        // Creating audio url with reference
                        // of created blob named 'audioData'
                        let audioSrc = window.URL
                            .createObjectURL(audioData);
                        let formData = new FormData();
                        formData.append("audio_notes", audioData);
                        formData.append('user_id', parentForm.user_id)
                        formData.append('layer_id', parentForm.layer_id)
                        formData.append('written_notes', parentForm.written_notes)
                        axios.post(route('notes.store'), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then(response => {
                            parentThis.toast.success(response.data.message);
                            parentThis.getNote()
                        });
                        playAudio.src = audioSrc;
                    }
                }
            )
            .catch(function (err) {
                console.log(err.name, err.message);
            });
    }
}
</script>
