<template>
    <app-layout>
        <div class="container" style="margin-top: -50px">
            <div class=" row flex-column align-items-center p-4">
                <h3 id="topic" ref="title" class="text-center">{{ video.title }}</h3>
                <iframe v-if="this.video.url" class="video-frame" id="youtube_id" allowfullscreen
                        :src="embed(this.video.url)"
                        style="max-width: 826px; width: 100%; height: 500px; margin: 0; border: none">
                </iframe>
                <h4 class="my-2">Video: {{ this.video.title }}</h4>
                <h4>Lesson: {{ this.lesson.name }}</h4>
                <div class="row justify-content-center my-4">
                    <div class="col-md-10">
                        <p class="text-justify">{{ this.video.message }}</p>
                    </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import Button from "@/Jetstream/Button";


export default {
    props: ['video', 'lesson'],

    components: {
        Button,
        AppLayout,
    },
    methods: {
        disableNotification(attribute) {
            localStorage.setItem(attribute, false);
        },
        embed: function (str) {
            let embeddedUrl = "https://player.vimeo.com/video/" + str + "?h=af48f9e87f&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479";
            return embeddedUrl;
        },
    },
    data() {
        return {
            video: this.video,
            lesson: this.lesson
        }
    },
    setup() {

    },
    mounted() {
        console.log(this.video)
        console.log(this.lesson)
    }
}
</script>
