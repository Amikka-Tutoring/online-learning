<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text">{{ date }}</h1>
            <div class="note-content my-5" v-for="(note,index) in notes" data-aos="fade-up">
                <div class="row create-notes-content">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-12">
                                <div class="row text-center justify-content-center topics-title mb-2">
                                    Lesson Name: {{ note.video.layer.name }}
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center my-4">
                            <div class="col-md-8">
                                <iframe class="notes-video" id="youtube_id" :src="embed(note.video.url)"
                                        style="max-width: 826px; width: 100%; height: 500px; margin: 10px 0; border: none">
                                </iframe>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 text-center my-5">
                                <h5 class="written-notes-title mb-4">Written Notes</h5>
                                <div class="written-notes-box position-relative">
                                    <a class="blue-text position-absolute"
                                       style="bottom: 10px; right: 50px"
                                       @click="writtenNotesStore(index)">Edit</a>
                                    <textarea class="text-box" name="" id="" cols="30" rows="7"
                                              v-model="form.written_notes[index]"></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center d-flex flex-column align-items-center">
                                <h5 class="written-notes-title mb-4">Audio Notes</h5>
                                <div class="d-flex flex-column align-items-center">
                                    <div class="audio-notes-box w-50 d-flex flex-column align-items-center mb-4">
                                        <button v-show="started" :id="'btnStop-'+index" class="border-0 bg-transparent"
                                                @click="stopped = true; started = false"><i
                                            class="fas fa-microphone-alt blue-text fa-2x"></i>
                                        </button>
                                        <button v-show="stopped" id="btnStart" v-on:click="record(index)"
                                                class="bg-transparent  border-0"><i
                                            class="fas fa-microphone-alt blue-text fa-2x"></i>
                                        </button>
                                        <div v-if="started" class="spinner-grow text-danger" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <audio :id="'adioPlay-'+index" controls class="d-none"></audio>
                                    <hr>
                                    <audio controls class="mb-4"
                                           :src="appUrl+note.audio_notes"></audio>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-3 text-right align-self-center">
                    <a v-if="prev_date" :href="route('notes-show',prev_date.id)" class="blue-text"
                       style="font-size: 50px">
                        <i class="bi bi-arrow-left-short"></i>
                    </a>
                    <p v-else style="font-size: 50px" class="m-0 p-0">
                        <i class="bi bi-arrow-left-short"></i>
                    </p>
                </div>
                <div class="col-3 align-self-center">
                    <a v-if="next_date" :href="route('notes-show',next_date.id)" class="blue-text"
                       style="font-size: 50px">
                        <i class="bi bi-arrow-right-short"></i>
                    </a>
                    <p v-else style="font-size: 50px" class="p-0 m-0">
                        <i class="bi bi-arrow-right-short"></i>
                    </p>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <h6 class="mb-4"><a :href="route('dashboard')">Exit Notebook</a></h6>
            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import moment from "moment";

export default {
    props: ['notes', 'appUrl', 'date', 'next_date', 'prev_date'],
    components: {
        AppLayout,
    },
    methods: {
        embed: function (str) {
            let embeddedUrl = "https://player.vimeo.com/video/" + str + "?h=af48f9e87f&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479";
            return embeddedUrl;
        },
        writtenNotesStore: function (index) {
            axios.post(route('notes.store'), {
                written_notes: this.form.written_notes[index],
                audio_notes: this.form.audio_notes[index],
                video_id: this.form.video_id[index],
                user_id: this.form.user_id[index],
            })
                .then(response => {
                    this.toast.success(response.data.message)
                }).catch(error => {
                this.toast.error('Something went wrong')
            })
        },
        getNote: function () {
            axios.get(route('get.note', this.note.id)).then(response => {
                this.note = response.data
            })
        },
        record: function (index) {
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

                        let stop = document.getElementById('btnStop-' + index);
                        let playAudio = document.getElementById('adioPlay-' + index);
                        console.log(stop, playAudio)

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
                            formData.append('user_id', parentForm.user_id[index])
                            formData.append('video_id', parentForm.video_id[index])
                            formData.append('written_notes', parentForm.written_notes[index])
                            console.log(formData)
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
                written_notes: [],
                audio_notes: [],
                video_id: [],
                user_id: []
            },
            moment: moment,
            started: false,
            stopped: true,
            note: this.notes,
            targetValue: 0
        }
    },
    mounted() {
        this.notes.forEach(element => {
            this.form.written_notes.push(element.written_notes)
            this.form.audio_notes.push(element.audio_notes)
            this.form.video_id.push(element.video_id)
            this.form.user_id.push(element.user_id)
        })
    }
}
</script>
