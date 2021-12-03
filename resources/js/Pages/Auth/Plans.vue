<template>
    <div data-aos="fade-up" class="pricing">
        <div class="container">
            <h1 class="text-center mt-4">Free, No Obligation Trial</h1>
            <div class="row justify-content-center mb-lg-5 mb-2">
                <div class="col-md-6">
                    <p class="info-text">Pick which option you’d like for your free trial. You won’t be charged until
                        after 7 days. If you
                        don’t
                        like it cancel with no strings attached.
                    </p>
                </div>
            </div>

            <div class="pricing-content">
                <div class="row" style="margin-bottom: 90px">
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-box">
                            <div class="box-badge">
                                <span>Most Popular</span>
                            </div>
                            <h3>Basic</h3>
                            <p>Enjoy your first 7 days free, then</p>
                            <h2>50$<span>/ month</span></h2>
                            <div class="row justify-content-center">
                                <button v-on:click="select('basic')">Start now</button>
                            </div>
                            <hr>
                            <div class="box-content">
                                <ul class="marker-list">
                                    <li><i class="bi bi-check-lg blue-text"></i>Access to 1,000+ videos</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Access to learning tools</li>
                                    <li>
                                        <ul class="sub-list">
                                            <li>Flash card creator</li>
                                            <li>In-app calculator</li>
                                            <li>Lesson reminders</li>
                                            <li>Write notes, draw notes, speak notes</li>
                                            <li>Flag questions</li>
                                        </ul>
                                    </li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Tutor text support</li>
                                    <li class="hidden-list">Video Response Support</li>
                                    <li class="hidden-list">Weekly 45min tutor check-in</li>
                                    <li class="hidden-list">1-on-1 tutoring discounts</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-box">
                            <h3>Support</h3>
                            <p>Enjoy your first 7 days free, then</p>
                            <h2>150$<span>/ month</span></h2>
                            <div class="row justify-content-center">
                                <button v-on:click="select('support')">Start now</button>
                            </div>
                            <hr>
                            <div class="box-content">
                                <ul class="marker-list">
                                    <li><i class="bi bi-check-lg blue-text"></i>Access to 1,000+ videos</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Access to learning tools</li>
                                    <li>
                                        <ul class="sub-list">
                                            <li>Flash card creator</li>
                                            <li>In-app calculator</li>
                                            <li>Lesson reminders</li>
                                            <li>Write notes, draw notes, speak notes</li>
                                            <li>Flag questions</li>
                                        </ul>
                                    </li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Tutor text support</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Tutor video support</li>
                                    <li class="hidden-list">Weekly 45min tutor check-in</li>
                                    <li class="hidden-list">1-on-1 tutoring discounts</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-box">
                            <div class="box-badge">
                                <span>Best Value</span>
                            </div>
                            <h3>Support+</h3>
                            <p>Enjoy your first 7 days free, then</p>
                            <h2>200$<span>/ month</span></h2>
                            <div class="row justify-content-center">
                                <button v-on:click="select('support+')">Start now</button>
                            </div>
                            <hr>
                            <div class="box-content">
                                <ul class="marker-list">
                                    <li><i class="bi bi-check-lg blue-text"></i>Access to 1,000+ videos</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Access to learning tools</li>
                                    <li>
                                        <ul class="sub-list">
                                            <li>Flash card creator</li>
                                            <li>In-app calculator</li>
                                            <li>Lesson reminders</li>
                                            <li>Write notes, draw notes, speak notes</li>
                                            <li>Flag questions</li>
                                        </ul>
                                    </li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Tutor text support</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Tutor video support</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>Weekly 45min tutor check-in</li>
                                    <li><i class="bi bi-check-lg blue-text"></i>1-on-1 tutoring discounts</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Plans",
    props: ['parent', 'user'],
    methods: {
        select: function (plan) {
            localStorage.setItem('plan', plan)
            if (this.user) {
                this.toast.info('Payment is being processed')
                axios.post(route('post.subscribe.plan', plan)).then(response => {
                    this.toast.success('Payment is finished')
                    window.location.href = '/dashboard'
                }).catch(error => {
                    console.log(error.response())
                })
            } else {
                this.parent.plan = plan
            }

        }
    },
    mounted() {
        localStorage.removeItem('plan')
    }
}
</script>
<style scoped>

.pricing {
    background: white;
    margin: 0 !important;
    padding: 0 !important;
}

.pricing h1 {
    color: rgba(14, 111, 255, 0.5);
    padding-top: 40px;
}

.pricing p.info-text {
    font-size: 18px;
    text-align: justify;
}

.pricing .pricing-box p {
    text-align: center;
}

.pricing .pricing-box p {
    margin-bottom: 0 !important;
    margin-top: 20px !important;
}

.pricing .pricing-box h2 {
    margin-top: 20px !important;
}

.pricing .pricing-box button {
    padding: 5px 60px;
    border-radius: 5px;
    margin-top: 20px;
}

.pricing .pricing-box {
    border: 2px solid #3261C8;
}

.pricing .pricing-box ul.marker-list {
    list-style-type: none;
    padding: 0;
}

.pricing .pricing-box ul.marker-list li {
    padding: 8px 0;
}

.pricing .pricing-box ul.marker-list li.hidden-list {
    list-style-type: none;
    color: rgba(38, 50, 56, 0.3);
    padding-left: 30px;
}

.pricing .pricing-box ul.marker-list li i {
    margin-right: 15px;
}

.pricing .pricing-box ul.sub-list {
    list-style-type: disc;
}

.pricing .pricing-box ul.sub-list li {
    padding: 0;
}

.pricing .pricing-box ul.sub-list {
    padding-left: 65px;
}

@media (max-width: 767.98px) {
    .pricing p.info-text {
        font-size: 12px;
    }

    .box-badge {
        padding: 5px 40px;
    }
}

</style>
