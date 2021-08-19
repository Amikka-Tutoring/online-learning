<template>
    <app-layout>
        <div class="container">
            <div class="practice-exams" data-aos="fade-up">
                <h1 class="blue-text">Practice Exams</h1>
                <div class="practice-exams-content">
                    <p class="question-box">Because your exam is <span class="blue-text">two weeks away</span> we recommend that you add at least <span class="blue-text">two full timed practice exams</span> before then. Press the <span class="blue-text">+</span> button to add study times that may work for you.  </p>
                    <div class="row d-flex justify-content-center">
                        <div class="exam-box" data-aos="fade-up">
                            <div class="exam-box-tile"><h1>Practice Exams</h1></div>
                            <div class="exam-box-list">
                                <div class="row p-2 mb-3 mt-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Practice Exam 1
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Practice Exam 2
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Real Exam Day
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <h5 class="blue-text">7/11</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="video-exams" data-aos="fade-up">
                <h1 class="blue-text">Videos and Quizzes</h1>
                <div class="video-exams-content">
                    <p class="question-box">On top of building your <span class="blue-text">endurance</span> for the full test it’s important to <span class="blue-text">master</span> all of the content. We initially recommended that you schedule two <span class="blue-text">1.5 hour lessons per week.</span><br><br>However because your exam is in <span class="blue-text">2 weeks</span> and you want to <span class="blue-text">improve 100 points</span> we recommend that you do <span class="blue-text">our fast track course.</span><br><br><span class="blue-text">Practice makes perfect.</span></p>
                    <div class="row d-flex justify-content-center">
                        <div class="exam-box" data-aos="fade-up">
                            <div class="exam-box-tile"><h1>Videos and Quizzes</h1></div>
                            <div class="exam-box-list">
                                <div class="row p-2 mb-3 mt-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Which Recommendation Do You Want?
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        What Other Days Can You Practice?
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        What Times Work For You?
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Real Exam Day
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <h5 class="blue-text">7/11</h5>
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

export default {
    components: {
        AppLayout,
    },
    methods: {

    },

    data() {
        return {

        }
    },
}
</script>
