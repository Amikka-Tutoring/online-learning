<template>
    <app-layout>
        <tools-menu :form="this.form" :question_form="this.questionForm" :videos="next_videos" :video="video"/>

        <div class="container" style="margin-top: -50px">

            <div class=" row flex-column align-items-center p-4">
                <h3 id="topic" ref="title" class="text-center">{{ video.title }}</h3>
                <iframe class="video-frame" id="youtube_id" allowfullscreen
                        :src="embed(video.url)"
                        style="max-width: 826px; width: 100%; height: 500px; margin: 50px 0; border: none">
                </iframe>
            </div>
            <div class="row justify-content-center mb-5"
                 style="font-size: 20px;font-weight: 400;font-style: italic;text-decoration: underline;">
                <div class="col-md-2 col-6 text-center" v-if="prev_link">
                    <div class="blue-link">
                        <a :href="route('lesson',prev_link)">Prev Video</a>
                    </div>
                </div>
                <div class="col-md-2 col-6 text-center" v-if="next_link">
                    <div class="blue-link">
                        <a :href="route('lesson',next_link)">Next Video</a>
                    </div>
                </div>
            </div>


            <div v-if="video.layer.questions.length" class="video-quiz-btn row justify-content-center"
                 style="margin-bottom: 100px">
                <button class="blue-button" @click="quiz(video.layer.id)" v-if="user_attempt === 0">Quiz
                </button>
                <button class="blue-button" v-if="user_attempt !== 0"
                        disabled="">Quiz Completed <i class="ml-2 bi bi-check-circle-fill"
                                                      style="color: rgb(131, 213, 131);"></i>
                </button>
            </div>
        </div>
        <div class="notes-section">
            <div class="container">
                <h1 class="blue-text text-center mb-4">Notes</h1>
                <div class="notes-section-content d-flex justify-content-center align-items-center flex-column">
                    <div class="row d-flex justify-content-center">
                        <transition name="list">
                            <div v-if="notes_section" class="question-box text-left">
                                <div class="row">
                                    <div class="col-lg-11 col-10">
                                        If you’re an auditory learner it may help to use our voice note feature as well
                                        as written notes. If you’re a visual learner written notes might be more
                                        beneficial for
                                        you.
                                    </div>
                                    <div class="col-lg-1 col-2 d-flex align-items-center">
                                        <i v-on:click="notes_section = disableNotification('notes_section')"
                                           class="fas fa-times red-text"></i>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="notes-box row w-75">
                        <div class="col-3">
                            <div class="row">
                                <div class="notes-circle rounded-circle" title="Voice Notes"
                                     v-on:click="openAudio"
                                ><i
                                    class="fas fa-microphone-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div v-on:click="flag(video)" class="notes-circle rounded-circle"
                                     title="Save for later"><i
                                    class="fas fa-flag"></i></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="notes-circle rounded-circle" title="Write Notes"
                                     v-on:click="openNotes"><i class="fas fa-pen"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row border-right-0">
                                <div class="notes-circle rounded-circle" title="Ask a Question"
                                     v-on:click="openQuestions">
                                    <i class="fas fa-question"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="notes-box row w-75 notes-box-content">
                        <div class="col-12">
                            <div v-if="written" class="written_notes p-md-4 p-2">
                                <form action="" @submit.prevent="submit">
                                    <h1 class="blue-text">Written Notes</h1>
                                    <textarea required v-model="form.written_notes" id="" cols="80" rows="20"
                                              name="written_notes"
                                              placeholder="Notes..."></textarea>
                                    <button class="light-button">Submit</button>
                                </form>
                            </div>
                            <div v-if="questions" class="questions p-md-4 p-2">
                                <form action="" @submit.prevent="submitQuestion">
                                    <h1 class="blue-text">Questions</h1>
                                    <textarea required v-model="questionForm.question_text" cols="80" rows="20"
                                              name="question_text"
                                              placeholder="Question..."></textarea>
                                    <button class="light-button">Submit</button>
                                </form>
                            </div>
                            <div v-show="audio"
                                 class="audio h-100" style="margin:100px">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="w-50 d-flex flex-column align-items-center mb-4">
                                        <button v-show="started" id="btnStop" class="border-0 bg-transparent"><i
                                            class="fas fa-microphone-alt blue-text fa-2x"></i>
                                        </button>
                                        <button v-show="stopped" id="btnStart" class="bg-transparent  border-0"
                                                v-on:click="record"><i
                                            class="fas fa-microphone-alt blue-text fa-2x"></i>
                                        </button>
                                        <div v-if="started" class="spinner-grow text-danger" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <audio id="adioPlay" controls></audio>
                                    <!--                                    <audio controls :src="appUrl+notes.audio_notes"></audio>-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="faq">
                <h1 class="blue-text text-center mb-4">Student FAQ</h1>
                <div class="faq-section-content d-flex justify-content-center align-items-center flex-column">
                    <div class="row d-flex justify-content-center">
                        <transition name="list">
                            <div v-if="faq_section" class="question-box text-left">
                                <div class="row">
                                    <div class="col-lg-11 col-10">
                                        Still confused? Check out the student FAQ’s below with video responses.
                                    </div>
                                    <div class="col-lg-1 col-2 d-flex align-items-center">
                                        <i v-on:click="faq_section = disableNotification('faq_section')"
                                           class="fas fa-times red-text"></i>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="recommended-box col-md-6 col-12">
                        <div class="recommended-title">Top Questions</div>
                        <div class="recommended-list">
                            <div class="recommended-item" v-for="response in video.responses">
                                <a :href="route('video.response',{video:this.video, response:response})"
                                   style="text-decoration: none">
                                    <div class="row">
                                        <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                            <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                        </div>
                                        <div class="col-10 d-flex align-items-center">
                                            <h5>{{ response.title }}
                                            </h5>
                                        </div>
                                    </div>
                                </a>
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
    props: ['video', 'notes', 'user', 'user_attempt', 'appUrl', 'next_link', 'prev_link', 'next_videos'],

    components: {
        Button,
        AppLayout,
        ToolsMenu,
    },
    methods: {
        openAudio: function () {
            this.audio = true;
            this.questions = false;
            this.written = false
            this.toast.info('Record notes to review later');
        },
        openNotes: function () {
            this.questions = false;
            this.written = true;
            this.audio = false
            this.toast.info('Write notes to review later');
        },
        openQuestions: function () {
            this.questions = true;
            this.written = false;
            this.audio = false
            this.toast.info('Ask our tutors a question');
        },
        disableNotification(attribute) {
            localStorage.setItem(attribute, false);
        },
        embed: function (str) {
            let embeddedUrl = "https://player.vimeo.com/video/" + str + "?h=af48f9e87f&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479";
            return embeddedUrl;
        },
        quiz: function (lesson_id) {
            Inertia.get(route('lesson.quiz', lesson_id))
        },
        flag: function (video) {
            axios.post(route('flag.video', video)).then(response => {
                this.toast.success(response.data.message)
            }).catch(error => {
                Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
            });
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
                    console.log(response.data.message)
                    this.toast.success(response.data)
                    this.questionForm.question_text = null
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        record: function () {
            let audioIN = {audio: true};

            let parentForm = this.form
            let parentThis = this

            navigator.mediaDevices.getUserMedia(audioIN)
                .then(function (mediaStreamObj) {
                        let mediaRecorder = new MediaRecorder(mediaStreamObj);
                        mediaRecorder.start();
                        mediaRecorder.onstart = function (ev) {
                            setTimeout(() => {
                                parentThis.started = true
                                parentThis.stopped = false
                            }, 800)
                        }

                        let stop = document.getElementById('btnStop');
                        let playAudio = document.getElementById('adioPlay');

                        stop.addEventListener('click', function (ev) {
                            mediaRecorder.stop();
                        });
                        mediaRecorder.ondataavailable = function (ev) {
                            dataArray.push(ev.data);
                        }

                        let dataArray = [];
                        mediaRecorder.onstop = function (ev) {
                            parentThis.stopped = true
                            parentThis.started = false

                            let audioData = new Blob(dataArray,
                                {'type': 'audio/mp3;'});

                            dataArray = [];
                            let audioSrc = window.URL
                                .createObjectURL(audioData);
                            let formData = new FormData();
                            formData.append("audio_notes", audioData);
                            formData.append('user_id', parentForm.user_id)
                            formData.append('video_id', parentForm.video_id)
                            formData.append('written_notes', parentForm.written_notes)
                            axios.post(route('notes.store'), formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then(response => {
                                parentThis.toast.success(response.data.message);
                            });
                            playAudio.src = audioSrc;
                        }
                    }
                )
                .catch(function (err) {
                    console.log(err.name, err.message);
                });
        }
    },
    data() {
        return {
            written: false,
            questions: false,
            audio: false,
            stopped: true,
            started: false,
            form: {
                written_notes: this.notes?.written_notes,
                audio_notes: this.notes?.audio_notes,
                video_id: this.video.id,
                user_id: this.notes?.user_id
            },
            questionForm: {
                question_text: null,
                video_id: this.video.id,
            },
            notes: this.notes,
            faq_section: localStorage.getItem('faq_section') === 'true',
            notes_section: localStorage.getItem('notes_section') === 'true',
        }
    },
    setup() {
        let saved = localStorage.getItem('video_page') === null;
        if (saved) {
            localStorage.setItem('faq_section', true)
            localStorage.setItem('notes_section', true)
            localStorage.setItem('video_page', true)
        }
    },
    view: function () {
        console.log('in method')

    },
    mounted() {
        const iframe = document.querySelector('iframe');
        const player = new Vimeo.Player(iframe);
        const parent = this
        player.on('play', function () {
            axios.post(route('view.video', parent.video)).then(response => {
                console.log(response.data)
            }).catch(error => {
                console.log(error.response)
            })
        });
    }
}
</script>


