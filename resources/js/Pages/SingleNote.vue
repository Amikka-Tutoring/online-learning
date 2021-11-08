<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text mb-5">{{ moment(note.created_at).format("MM/DD") }}</h1>
            <div class="row create-notes-content">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-12">
                            <div class="row text-center justify-content-center topics-title mb-2">
                                Lesson Name
                            </div>
                            <div style="padding: 10px"
                                 class="row written-notes-boxes text-center justify-content-center">
                                {{ note.video.layer.name }}
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-4">
                        <div class="col-md-8">
                            <iframe id="youtube_id" :src="embed(note.video.url)"
                                    style="max-width: 826px; width: 100%; height: 500px; margin: 90px 0; border: none">
                            </iframe>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 text-center my-5">
                            <h5 class="written-notes-title mb-4">Written Notes</h5>
                            <div class="written-notes-box position-relative">
                                <a class="blue-text position-absolute"
                                   style="bottom: 10px; right: 50px" @click="writtenNotesStore">Edit</a>
                                <textarea class="h-auto" name="" id="" cols="30" rows="7"
                                          v-model="form.written_notes"></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center d-flex flex-column align-items-center">
                            <h5 class="written-notes-title mb-4">Audio Notes</h5>
                            <div class="d-flex flex-column align-items-center">
                                <div class="audio-notes-box w-50 d-flex flex-column align-items-center mb-4">
                                    <button v-show="started" id="btnStop" class="border-0 bg-transparent"
                                            @click="stopped = true; started = false"><i
                                        class="fas fa-microphone-alt blue-text fa-2x"></i>
                                    </button>
                                    <button v-show="stopped" id="btnStart" v-on:click="record"
                                            class="bg-transparent  border-0"><i
                                        class="fas fa-microphone-alt blue-text fa-2x"></i>
                                    </button>
                                    <div v-if="started" class="spinner-grow text-danger" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <audio id="adioPlay" controls class="d-none"></audio>
                                <hr>
                                <audio controls
                                       :src="appUrl+note.audio_notes"></audio>
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
import moment from "moment";

export default {
    props: ['note', 'appUrl'],
    components: {
        AppLayout,
    },
    methods: {
        embed: function (str) {
            let embeddedUrl = "https://player.vimeo.com/video/" + str + "?h=af48f9e87f&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479";
            return embeddedUrl;
        },
        writtenNotesStore: function () {
            axios.post(route('notes.store'), this.form)
                .then(response => {
                    this.toast.success(response.data.message)
                })
        },
        getNote: function () {
            axios.get(route('get.note', this.note.id)).then(response => {
                this.note = response.data
            })
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
    },

    data() {
        return {
            form: {
                written_notes: this.note.written_notes,
                audio_notes: this.note.audio_notes,
                video_id: this.note.video_id,
                user_id: this.note.user_id
            },
            moment: moment,
            started: false,
            stopped: true,
            note: this.note,
            targetValue: 0
        }
    },
    mounted() {

    }
}
</script>
