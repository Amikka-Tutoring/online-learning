<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text mb-5">7/11</h1>
            <div class="row create-notes-content">
                <div class="col-lg-7 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="row text-center justify-content-center topics-title mb-2">
                                <i class="fas fa-pen mr-2 blue-text"></i>Topic
                            </div>
                            <div style="padding: 10px"
                                 class="row written-notes-boxes text-center justify-content-center">
                                Linear equations
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
                            <h5 class="written-notes-title">Written Notes</h5>
                            <div class="written-notes-box">
                                <a href="" class="blue-text position-absolute"
                                   style="bottom: 10px; right: 50px">Edit</a>
                                <textarea name="" id="" cols="30" rows="17">On my seventeenth birthday, I presented at a science fair affiliated with my school district about my research on how the color of paper can affect the readability of the text on the paper.  This was the first time I really investigated how important contrast is when creating accessible documents, and I was able to determine the colors of paper I preferred for my assignments.  When I presented this research to the science fair judges, I received an unexpected surprise- three out of the five judges were colorblind!  Globally, one in twelve men and one in two hundred women are colorblind, and the odds of encountering two men and one women who are colorblind in a room seemed to be one in a million.  My friends and family found this experience absolutely hilarious, and told me that it would be a great story to tell if I ever presented my research again.  At the time I didn't find the experience very funny at the time, but over time I have done more and more research on what colors of paper work best for text.</textarea>

                            </div>
                        </div>
                        <div class="col-lg-4 col-12 text-center d-flex flex-column align-items-center">
                            <h5 class="written-notes-title">Audio Notes</h5>
                            <div class="audio-notes-box w-50 d-flex flex-column align-items-center">
                                <i class="fas fa-microphone-alt blue-text fa-2x"></i>
                                <p class="blue-text">Play</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <img style="max-width: 826px; width: 100%" :src="'/images/lesson.png'">
                </div>
            </div>
        </div>
        <hr class="blue-divider">
        <div class="container">
            <div class="row create-notes-content">
                <div class="col-lg-7 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="row text-center justify-content-center topics-title mb-2">
                                <i class="fas fa-pen mr-2 blue-text"></i>Topic
                            </div>
                            <div style="padding: 10px"
                                 class="row written-notes-boxes text-center justify-content-center">
                                Linear equations
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
                            <h5 class="written-notes-title">Written Notes</h5>
                            <div class="written-notes-box">
                                <a href="" class="blue-text position-absolute"
                                   style="bottom: 10px; right: 50px">Edit</a>
                                <textarea name="" id="" cols="30" rows="17">On my seventeenth birthday, I presented at a science fair affiliated with my school district about my research on how the color of paper can affect the readability of the text on the paper.  This was the first time I really investigated how important contrast is when creating accessible documents, and I was able to determine the colors of paper I preferred for my assignments.  When I presented this research to the science fair judges, I received an unexpected surprise- three out of the five judges were colorblind!  Globally, one in twelve men and one in two hundred women are colorblind, and the odds of encountering two men and one women who are colorblind in a room seemed to be one in a million.  My friends and family found this experience absolutely hilarious, and told me that it would be a great story to tell if I ever presented my research again.  At the time I didn't find the experience very funny at the time, but over time I have done more and more research on what colors of paper work best for text.</textarea>

                            </div>
                        </div>
                        <div class="col-lg-4 col-12 text-center d-flex flex-column align-items-center">
                            <h5 class="written-notes-title">Audio Notes</h5>
                            <div class="audio-notes-box w-50 d-flex flex-column align-items-center">
                                <i class="fas fa-microphone-alt blue-text fa-2x"></i>
                                <p class="blue-text">Play</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <img style="max-width: 826px; width: 100%" :src="'/images/lesson.png'">
                </div>
            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    methods: {},

    data() {
        return {}
    },
}
</script>
