<template>
    <div class="tools-menu">
        <ul style="max-height: 100vh; overflow: scroll">
            <li @click="next = !next">Next <i class="pl-2 blue-text fas"
                                              v-bind:class="next ? 'fa-arrow-up' : 'fa-arrow-down'"></i></li>
            <collapse-transition>
                <li v-show="next">
                    <div class="next-lessons">
                        <div class="next-up">Next Up</div>
                        <div v-for="video in videos" class="next-item" v-if="videos.length">
                            <a :href="route('lesson',video)" style="text-decoration: none">
                                <div class="row m-0 py-2" style="overflow: hidden">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i v-if="video.viewed"
                                           class="bi bi-check-circle-fill"
                                           style="color: #4C6ED7; font-size: 1.5em"></i>
                                        <i v-else
                                           class="far fa-circle fa-2x"
                                           style="color: #4C6ED7; font-size: 1.5em"></i>
                                    </div>
                                    <div class="col-5 align-self-center">
                                        <div class="row">
                                            <p class="text-left m-0">{{ video.title }}</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-center">
                                        <div class="row">
                                        <span style="width: 100%" v-for="tag in video.tags"
                                              class="ml-2 mb-1 badges lightblue-badge">{{ tag.name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="" v-else>
                            No more videos
                        </div>
                    </div>
                </li>
            </collapse-transition>
            <li @click="tools = !tools" title="Click tools to learn more">Tools <i class="pl-2 blue-text fas"
                                                                                   v-bind:class="tools ? 'fa-arrow-up' : 'fa-arrow-down'"></i>
            </li>
            <collapse-transition>
                <li v-if="tools" class="p-0">
                    <div class="tools">
                        <div class="row">
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Ask a question"
                                     v-on:click="written_notes = false; question_box = true; audio=false; this.toast.info('Ask our tutors a question')">
                                    <i
                                        class="fas fa-question"></i></div>
                                <p>Ask</p>
                            </div>
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Write notes"
                                     v-on:click="written_notes = true; question_box = false; audio = false; this.toast.info('Write notes to review later')">
                                    <i class="fas fa-pen"></i></div>
                                <p>Write</p>
                            </div>
                            <div class="col-3">
                                <div v-on:click="flag(video)" class="notes-circle rounded-circle"
                                     title="Save for later"><i
                                    class="fas fa-flag"></i>
                                </div>
                                <p>Save</p>
                            </div>
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Voice notes"
                                     v-on:click="audio = true; written_notes = false; question_box = false;this.toast.info('Record notes to review later')">
                                    <i
                                        class="fas fa-microphone-alt"></i></div>
                                <p>Speak</p>
                            </div>
                        </div>
                        <collapse-transition>
                            <div v-if="written_notes">
                                  <textarea v-model="form.written_notes" placeholder="Notes..." cols="25"
                                            rows="10"></textarea>
                                <button v-on:click="submit">Submit</button>
                            </div>
                        </collapse-transition>
                        <collapse-transition>
                            <div v-if="question_box">
                                <textarea v-model="question_form.question_text" placeholder="Question..." id=""
                                          cols="25"
                                          rows="10"></textarea>
                                <button v-on:click="submitQuestion">Submit</button>
                            </div>
                        </collapse-transition>
                        <collapse-transition>
                            <div v-show="audio"
                                 class="audio h-100" style="margin-top: 5%">
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
                        </collapse-transition>
                        <div class="row">
                            <div class="tokens w-100">
                                <tokens class="justify-content-center" :tokens="tokens"/>
                            </div>
                        </div>
                    </div>
                </li>
            </collapse-transition>
        </ul>
    </div>
</template>

<script>

import CollapseTransition from '@ivanv/vue-collapse-transition/src'
import Tokens from "@/components/Tokens";

export default {
    components: {
        CollapseTransition,
        Tokens
    },
    methods: {
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
            axios.post(route('notes.store.question'), this.question_form)
                .then(response => {
                    this.toast.success(response.data)
                    this.question_form.question_text = null
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        flag: function (video) {
            axios.post(route('flag.video', video)).then(response => {
                this.toast.success(response.data.message)
            }).catch(error => {
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
    props: ['form', 'question_form', 'videos', 'video', 'tokens'],

    data() {
        return {
            next: false,
            tools: false,
            audio: false,
            stopped: true,
            started: false,
            written_notes: false,
            question_box: false,
            form: this.form,
            question_form: this.question_form
        }
    },
    mounted() {
        console.log(this.form)
    }
}
</script>
<style>
.tools .tokens img {
    width: 40px;
}

.tools .tokens h1 {
    font-size: 17px !important;
    margin-left: 10px
}

.tools .tokens .row {
    margin-bottom: 0 !important;
    margin-top: 20px;
}

.tools {
    padding-bottom: 5px;
}

.tools .row .col-3 {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}

.tools .row .col-3 p {
    color: rgba(14, 111, 255, 1);
    font-size: 16px;
    margin-top: 10px;
}
</style>
