<template>
    <app-layout>
        <div class="container">
            <div class="tutors">
                <h1><span class="blue-text">Our </span>Tutors</h1>
                <div class="tutors-content">
                    <div class="row">
                        <div class="col-lg-5">
                            <img :src="'/images/laptop1.png'">
                        </div>
                        <div class="col-lg-7">
                            <div class="row" style="margin-left: 50px">
                                <ol>
                                    <li>
                                        Scored in the top 1%.
                                    </li>
                                    <li>
                                        Are from Ivy League schools.
                                    </li>
                                    <li>
                                        Have hundreds of hours of experience.
                                    </li>
                                    <li>
                                        Help our students improve on average over 200 points on the SAT.
                                    </li>
                                </ol>
                            </div>
                            <div class="row">
                                <button class="blue-button">Contact Us</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-aos="fade-up" class="pricing">
                <h1><span class="blue-text">Our </span>Pricing</h1>
                <div class="pricing-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="price-box">
                                <div class="hours">
                                    20 Hours
                                </div>
                                <div class="content">
                                    <div class="row justify-content-center">
                                        <p class="align-self-end"><span
                                            style="font-size: 50px">60$ </span>/ HOUR</p>
                                    </div>
                                    <div class="row">
                                        <p class="text-center">
                                            This option typically yields 100+ SAT improvement over a 5 week period.
                                        </p>
                                    </div>
                                </div>
                                <div class="features">
                                    <i class="fas fa-plus mr-2"></i>Click To See Features
                                </div>
                                <div class="price-box-button text-center">
                                    <button>Contact Us</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="price-box">
                                <div class="hours">
                                    30 Hours
                                </div>
                                <div class="content">
                                    <div class="row justify-content-center">
                                        <p class="align-self-end"><span
                                            style="font-size: 50px">65$ </span>/ HOUR</p>
                                    </div>
                                    <div class="row">
                                        <p class="text-center">
                                            This option typically yields 200+ SAT improvement over a 8 week period.
                                        </p>
                                    </div>
                                </div>
                                <div class="features">
                                    <i class="fas fa-plus mr-2"></i>Click To See Features
                                </div>
                                <div class="price-box-button text-center">
                                    <button>Contact Us</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="price-box">
                                <div class="hours">
                                    40 Hours
                                </div>
                                <div class="content">
                                    <div class="row justify-content-center">
                                        <p class="align-self-end"><span
                                            style="font-size: 50px">70$ </span>/ HOUR</p>
                                    </div>
                                    <div class="row">
                                        <p class="text-center">
                                            This option typically yields 250+ SAT improvement over a 10 week period.
                                        </p>
                                    </div>
                                </div>
                                <div class="features">
                                    <i class="fas fa-plus mr-2"></i>Click To See Features
                                </div>
                                <div class="price-box-button text-center">
                                    <button>Contact Us</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-aos="fade-up" class="reach-out">
                <h1><span class="blue-text">Reach </span>Out</h1>
                <div class="tutors-content">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-12">
                            <div class="reach-form">
                                <form action="">
                                    <div class="form-group">
                                        <i class="fas fa-envelope icon fa-2x"></i>
                                        <input type="text" placeholder="Enter your phone number">
                                    </div>
                                    <div class="form-group">
                                        <i class="fas fa-envelope icon fa-2x"></i>
                                        <textarea name="" id="" cols="30" rows="10"
                                                  placeholder="Describe what you’d like to discuss over the phone. If you know which package you’d like just let us know here. "></textarea>
                                    </div>

                                    <i class="fas fa-envelope icon fa-2x"></i>
                                    <input type="text" placeholder="What is your availability?">
                                    <button class="blue-button w-100">Submit</button>
                                </form>
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
    methods: {},

    data() {
        return {}
    },
}
</script>
