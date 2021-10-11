<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text mb-5">{{ moment(note.created_at).format("MM/DD") }}</h1>

            <div class="row create-notes-content">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="row text-center justify-content-center topics-title mb-2">
                                <i class="fas fa-pen mr-2 blue-text"></i>Topic
                            </div>
                            <div style="padding: 10px"
                                 class="row written-notes-boxes text-center justify-content-center">
                                {{ note.lesson.name }}
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="row justify-content-center topics-title mb-2">
                                <i class="fas fa-tags mr-2 blue-text"></i>Tags
                            </div>
                            <div class="row written-notes-boxes text-center justify-content-center">
                                <span v-for="tag in note.lesson.tags" class="lightblue-badge badges">{{
                                        tag.name
                                    }}</span>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-12 text-center">

                            <!--                            <audio :src="note.audio_notes"></audio>-->
                            <h5 class="written-notes-title">Written Notes</h5>
                            <div class="written-notes-box position-relative">
                                <a class="blue-text position-absolute"
                                   style="bottom: 10px; right: 50px" @click="writtenNotesStore">Edit</a>
                                <textarea class="h-auto" name="" id="" cols="30" rows="7"
                                          v-model="form.written_notes"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 text-center d-flex flex-column align-items-center">
                            <h5 class="written-notes-title">Audio Notes</h5>
                            <div class="d-flex flex-column align-items-center">
                                <div class="audio-notes-box w-50 d-flex flex-column align-items-center mb-4">
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
                                <audio id="adioPlay" controls class="d-none"></audio>
                                <hr>
                                <audio controls
                                       :src="'http://localhost:8000/'+note.audio_notes"></audio>
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
    props: ['note'],
    components: {
        AppLayout,
    },
    methods: {
        writtenNotesStore: function () {
            axios.post(route('notes.store'), this.form)
                .then(response => {
                    this.toast.success(response.data.message)
                })
        },
        getNote: function () {
            axios.get(route('get.note', this.note.id)).then(response => {
                console.log('from get note')
                this.note = response.data
            })
        }
    },

    data() {
        return {
            form: {
                written_notes: this.note.written_notes,
                audio_notes: this.note.audio_notes,
                layer_id: this.note.layer_id,
                user_id: this.note.user_id
            },
            moment: moment,
            started: false,
            stopped: true,
            note: this.note
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
