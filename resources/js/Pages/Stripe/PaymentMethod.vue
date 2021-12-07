<template>
    <app-layout>
        <div class="container">
            <div class="row justify-content-center align-content-center h-100">
                <div class="col-md-4 h-auto p-0 m-0">
                    <form id="subscribe-form" class="form p-2 m-0 mt-4" @submit.prevent>
                        <div class="card p-3 text-center">
                            <img :src="'images/card.png'" alt="" class="pb-4 credit-card">
                            <div class="">
                                <p>Enter your card details:</p>
                                <input id="card-holder-name" type="text" class="form-control mb-4"
                                       placeholder="Card Holder Name">
                                <input id="payment_method" type="hidden" name="payment_method" v-model="payment_method">
                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element" class="form-control"></div>
                                <p class="text-right mt-2 mb-0" v-if="this.price">Total price: <span
                                    class="blue-text font-weight-bold" style="font-size: 20px">{{ this.price }} $</span>
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <button :disabled="loading" id="card-button" :data-secret="intent.client_secret"
                                    class="btn btn-primary w-100 d-flex items-center text-uppercase justify-content-center align-items-center">
                                {{ submit_text }}
                                <div v-if="loading" class="spinner-border spinner-border-sm ml-2"/>
                                <i
                                    style="color: #83d583"
                                    v-if="onsuccess" class="ml-2 bi bi-check-circle-fill" data-aos="zoom-in"
                                    data-aos-delay="300"></i>
                            </button>
                        </div>
                    </form>
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
    props: ['intent', 'plans', 'STRIPE_KEY'],

    data() {
        return {
            loading: false,
            onsuccess: false,
            submit_text: 'SUBMIT',
            price: null
        }
    },
    mounted() {
        if (localStorage.getItem('plan')) {
            switch (localStorage.getItem('plan')) {
                case 'support+':
                    this.price = 200
                    break
                case 'support':
                    this.price = 150
                    break
                default:
                    this.price = 50
            }
        }
        const stripe = Stripe(this.STRIPE_KEY);

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            this.loading = true
            this.submit_text = 'PROCESSING...'
            const {setupIntent, error} = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {name: cardHolderName.value}
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                this.toast.error(error.message)
                this.loading = false
                this.submit_text = 'SUBMIT'
            } else {
                // The card has been verified successfully...
                axios.post(route('set.payment.method'), {
                    payment_method: setupIntent.payment_method
                }).then(response => {
                    this.submit_text = 'SUCCESS'
                    this.onsuccess = true
                    window.location.href = '/initial-questionnaire'
                }).catch(error => {
                    this.toast.error('Something went wrong!')
                }).finally(() => {
                    this.loading = false
                    this.submit_text = 'SUBMIT'
                });
            }
        });
    },
}
</script>

<style>
.card {
    display: block;
    box-shadow: 0 7px 14px 0 rgb(49 49 93 / 10%), 0 3px 6px 0 rgb(0 0 0 / 8%);
}

img.credit-card {
    width: 65%;
    margin-top: -100px;
}

form button {
    float: left;
    display: block;
    background: #666EE8 !important;
    color: white;
    box-shadow: 0 7px 14px 0 rgb(49 49 93 / 10%), 0 3px 6px 0 rgb(0 0 0 / 8%);
    border-radius: 4px;
    border: 0;
    margin-top: 20px;
    font-size: 15px;
    font-weight: 400;
    width: 100%;
    height: 40px;
    line-height: 38px;
    outline: none;
}
</style>
