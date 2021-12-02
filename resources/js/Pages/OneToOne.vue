<template>
  <app-layout>
    <div class="tutors">
      <div class="container">
        <h1 class="blue-text text-center">Our Tutors.</h1>
        <div class="tutors-content">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-5">
              <img src="/images/our_tutors.png" alt="">
            </div>
            <div class="col-md-7">
              <ul>
                <li>
                  Our tutors scored in the top 1% of every exam that they teach.
                </li>
                <li>
                  They have extensive experience helping our students get into their dream schools.
                </li>
                <li>
                  We have a small team in order to guarantee high score increases and student
                  satisfaction.
                </li>
                <li>
                  Before joining our team, our tutors go through an interview process in order to
                  ensure that they are capable of teaching at the amikka method level.
                </li>
              </ul>
            </div>
            <div class="col-md-3 mt-5">
              <button class="w-100 p-2">Sign Up</button>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="container">
      <div class="process" data-aos="fade-up">
        <h1 class="blue-text text-center">1-on-1 Tutoring Process.</h1>
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6">
            <img src="/images/process.png" alt="">
          </div>
          <div class="col-md-6">
            <ol>
              <li>
                Choose Your Package.
                <p>
                  After you decide whether you’d like 10, 20, or 30 hours of additional tutoring you
                  can sign up on this page. If you don’t end up using all of your hours don’t worry!
                  We have a money back guarantee policy.
                </p>
              </li>
              <li>
                Perfect Tutor Match.
                <p>
                  After you sign up we will match you with a tutor based on your personality type,
                  learning style, and current academic placement within 24 hours.
                </p>
              </li>
              <li>
                Fast Pick-Up.
                <p>
                  Your sessions will be held on our platform through video chat and your tutor will
                  have access to all of your progress so that you can pick up right where you left
                  off.
                </p>
              </li>
              <li>
                Immediate Support.
                <p>
                  Your tutor will help answer any questions that you’ve encountered during your self
                  paced course and give you an extra layer of support to help you succeed.
                </p>
              </li>
              <li>
                More Personalization.
                <p>
                  Our self paced personalization is industry leading but having a 1-on-1 tutor assess
                  you will add another layer of personalization to help you reach your goals faster.
                </p>
              </li>
              <li>
                Double Accountability.
                <p>
                  On top of getting email and SMS reminders for your upcoming lessons from the self
                  paced course, your 1-on-1 tutor will help ensure that you never miss a lesson or
                  practice exam.
                </p>
              </li>
              <li>
                Faster Success.
                <p>
                  Combining our self paced tutoring with 1-on-1 coaching yields the most success.
                  Our 1-on-1 tutors are the best in the nation. You can expect to improve 20% faster
                  with live coaching.
                </p>
              </li>
            </ol>
          </div>
          <div class="col-md-3 mt-5">
            <button class="w-100 p-2 mb-5">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
    <div data-aos="fade-up" class="pricing">
      <div class="container">
        <h1 class="text-white text-center">Simple, Clear Pricing.</h1>
        <div class="pricing-content">
          <div class="row" style="margin-bottom: 90px">
            <div class="col-lg-4 col-md-6">
              <div class="pricing-box">
                <h3>10 Hours</h3>
                <h2>$75<span>/ HOUR</span></h2>
                <p>
                  Best for students who need comprehensive support, a personalized plan, and large
                  score improvements.
                </p>
                <div class="row justify-content-center">
                  <button v-on:click="choosePlan(10)">Choose Plan</button>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="pricing-box">
                <div class="box-badge">
                  <span>Most Popular</span>
                </div>
                <h3>20 Hours</h3>
                <h2>$70<span>/ HOUR</span></h2>
                <p>
                  Best for students who need comprehensive support, a personalized plan, and large
                  score improvements.
                </p>
                <div class="row justify-content-center">
                  <button v-on:click="choosePlan(20)">Choose Plan</button>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="pricing-box">
                <h3>30 Hours</h3>
                <h2>$65<span>/ HOUR</span></h2>
                <p>
                  Best for students who need comprehensive support, a personalized plan, and large
                  score improvements.
                </p>
                <div class="row justify-content-center">
                  <button v-on:click="choosePlan(30)">Choose Plan</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center text-white money-back-section">
            <div class="col-md-8">
              <div class="row align-items-center">
                <div class="col-3 p-0">
                  <img src="/images/badge.png" alt="" class="w-100">
                </div>
                <div class="col-9 p-0">
                  <h4>Money Back Guarantee.</h4>
                  <p>
                    We are so confident that parents will notice a difference in their children, we
                    offer a
                    money-back guarantee at any point for the remaining hours on their account.
                  </p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div data-aos="fade-up" class="reach-out">
        <div class="tutors-content">
          <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
              <h1 style="font-size: 50px;">We'd Love To <br> Chat With You.</h1>
              <div class="stars-content">
                <span class="font-weight-bold">4.9</span>
                <span class="stars">
                                <svg width="45" height="43" viewBox="0 0 45 43" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.8362 1.50314L27.6087 16.1915L27.713 16.5125H28.0505H43.4948L31.0001 25.5904L30.7271 25.7888L30.8313 26.1097L35.6039 40.7981L23.1092 31.7202L22.8362 31.5218L22.5632 31.7202L10.0685 40.7981L14.841 26.1097L14.9453 25.7888L14.6723 25.5904L2.17761 16.5125H17.6219H17.9594L18.0636 16.1915L22.8362 1.50314Z"
                                        fill="#FDDA69" stroke="black" stroke-width="0.928994"/>
                                </svg>
                                <svg width="45" height="43" viewBox="0 0 45 43" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.8362 1.50314L27.6087 16.1915L27.713 16.5125H28.0505H43.4948L31.0001 25.5904L30.7271 25.7888L30.8313 26.1097L35.6039 40.7981L23.1092 31.7202L22.8362 31.5218L22.5632 31.7202L10.0685 40.7981L14.841 26.1097L14.9453 25.7888L14.6723 25.5904L2.17761 16.5125H17.6219H17.9594L18.0636 16.1915L22.8362 1.50314Z"
                                        fill="#FDDA69" stroke="black" stroke-width="0.928994"/>
                                </svg>
                                <svg width="45" height="43" viewBox="0 0 45 43" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.8362 1.50314L27.6087 16.1915L27.713 16.5125H28.0505H43.4948L31.0001 25.5904L30.7271 25.7888L30.8313 26.1097L35.6039 40.7981L23.1092 31.7202L22.8362 31.5218L22.5632 31.7202L10.0685 40.7981L14.841 26.1097L14.9453 25.7888L14.6723 25.5904L2.17761 16.5125H17.6219H17.9594L18.0636 16.1915L22.8362 1.50314Z"
                                        fill="#FDDA69" stroke="black" stroke-width="0.928994"/>
                                </svg>
                                <svg width="45" height="43" viewBox="0 0 45 43" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.8362 1.50314L27.6087 16.1915L27.713 16.5125H28.0505H43.4948L31.0001 25.5904L30.7271 25.7888L30.8313 26.1097L35.6039 40.7981L23.1092 31.7202L22.8362 31.5218L22.5632 31.7202L10.0685 40.7981L14.841 26.1097L14.9453 25.7888L14.6723 25.5904L2.17761 16.5125H17.6219H17.9594L18.0636 16.1915L22.8362 1.50314Z"
                                        fill="#FDDA69" stroke="black" stroke-width="0.928994"/>
                                </svg>
                                <svg width="45" height="43" viewBox="0 0 45 43" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.8362 1.50314L27.6087 16.1915L27.713 16.5125H28.0505H43.4948L31.0001 25.5904L30.7271 25.7888L30.8313 26.1097L35.6039 40.7981L23.1092 31.7202L22.8362 31.5218L22.5632 31.7202L10.0685 40.7981L14.841 26.1097L14.9453 25.7888L14.6723 25.5904L2.17761 16.5125H17.6219H17.9594L18.0636 16.1915L22.8362 1.50314Z"
                                        fill="#FDDA69" stroke="black" stroke-width="0.928994"/>
                                </svg>
                            </span>
                <span style="font-size: 17px">504 verified ratings</span>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form">
                <h2>Do you have any questions?</h2>
                <p>We'd love to answer them!</p>
                <form v-on:submit="submitForm">
                  <input type="email" placeholder="Email" v-model="form.email" required>
                  <input type="text" placeholder="Phone Number" v-model="form.phone" required>
                  <textarea cols="30" rows="10" placeholder="Message" required
                            v-model="form.message"></textarea>
                  <input :disabled="disabled" type="submit" value="Submit">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
  <div class="modal fade" id="modal" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ this.plan }} Hours Plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Select way of payment</label>
            <select name="" v-model="method" id="" class="form-control">
              <option value="2">Half</option>
              <option value="1">Full</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button :disabled="loading" type="button" class="btn btn-primary" v-on:click="makePayment">Proceed
            <div v-if="loading" class="spinner-border spinner-border-sm ml-2"/>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
  components: {
    AppLayout,
  },
  methods: {
    submitForm: function () {
      this.disabled = true
      axios.post(route('submit-one-to-one'), this.form)
          .then(response => {
            this.toast.success(response.data.message)
            this.form.phone = null;
            this.form.email = null;
            this.form.message = null;
          }).catch(error => {
        Object.values(error).flat().forEach(element => this.toast.error(element))
      }).finally(() => {
        this.disabled = false
      });
    },
    choosePlan: function (plan) {
      this.plan = plan
      $('#modal').modal('show')
    },
    makePayment: function () {
      if (this.method != null) {
        this.loading = true
        axios.post(route('pay.one-to-one'), {
          price: this.price / Number(this.method),
          payment_method_text: this.method === '2' ? 'Half' : 'Full',
          payment_method: this.method,
          plan: this.plan
        }).then(response => {
          console.log(response.data)
          this.toast.success(response.data.message)
        }).catch(error => {
          console.log(error.response)
          this.toast.error('Something went wrong!')
        }).finally(() => {
          $('#modal').modal('hide')
          this.loading = false
        })
      }
    }
  },

  data() {
    return {
      disabled: false,
      form: {
        phone: null,
        discussion: null,
        availability: null,
      },
      plan: null,
      method: null,
      loading: false
    }
  },
}
</script>
<style>
.banner-img {
  margin-bottom: 25px !important;
}
</style>
