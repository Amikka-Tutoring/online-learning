<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text mb-5">10/09</h1>
            <!--            <p>-->
            <!--                <button id="btnStart">START RECORDING</button>-->

            <!--                <button id="btnStop">STOP RECORDING</button>-->
            <!--                &lt;!&ndash;button for 'stop recording'&ndash;&gt;-->
            <!--            </p>-->

            <!--            &lt;!&ndash;for record&ndash;&gt;-->
            <!--            &lt;!&ndash;            <audio controls></audio>&ndash;&gt;-->

            <!--            &lt;!&ndash;for play the audio&ndash;&gt;-->
            <!--            <audio id="adioPlay" controls></audio>-->
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
                                <span class="lightblue-badge badges">Lesson</span>
                                <span class="gray-badge badges">Strategy</span>
                                <span class="lightrose-badge badges">Medium</span>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-12 text-center">

                            <!--                            <audio :src="note.audio_notes"></audio>-->
                            <h5 class="written-notes-title">Written Notes</h5>
                            <div class="written-notes-box">
                                <a href="" class="blue-text position-absolute"
                                   style="bottom: 10px; right: 50px">Edit</a>
                                <textarea name="" id="" cols="30" rows="17">{{note.written_notes}}</textarea>

                            </div>
                        </div>
                        <div class="col-lg-4 col-12 text-center d-flex flex-column align-items-center">
                            <h5 class="written-notes-title">Audio Notes</h5>
                            <div class="d-flex flex-column align-items-center">
                                <audio controls
                                       :src="note.audio_notes"></audio>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <div class="col-lg-5 col-12">-->
                <!--                    <img style="max-width: 826px; width: 100%" :src="'/images/lesson.png'">-->
                <!--                </div>-->
            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: ['note'],
    components: {
        AppLayout,
    },
    methods: {
        callback(data) {
            console.debug(data)
        },
        saveAudio(data) {
            console.log(data)
        }
    },

    data() {
        return {
            form: {
                written_notes: 'test',
                audio_notes: null,
                layer_id: 1,
                user_id: 1
            }
        }
    },
    mounted() {
        console.log(this.note);
        let audioIN = {audio: true};
        //  audio is true, for recording

        // Access the permission for use
        // the microphone
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
                    console.log('data array')
                    console.log(dataArray)

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

                    console.log('audio file:')
                    console.log(audioSrc, dataArray, audioData)
                    console.log(this, this.this)
                    this.this.saveAudio('123');
                    // axios.post(route('notes.store'), this.form).then()

                    // Pass the audio url to the 2nd video tag
                    playAudio.src = audioSrc;
                }
            })
            .catch(function (err) {
                console.log(err.name, err.message);
            });
    }
}
</script>
