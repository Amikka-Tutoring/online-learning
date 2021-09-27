<form id="subscribe-form" action="subscribe" method="POST">
    @csrf
    @foreach($plans as $plan)
        <div class="col-md-4">
            <div class="subscription-option">
                <input type="radio" id="plan-silver" name="plan" value='{{$plan->id}}'>
                <label for="plan-silver">
                    <span
                        class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                    <span class="plan-name">{{$plan->product->name}}</span>
                </label>
            </div>
        </div>
    @endforeach
    <input id="card-holder-name" type="text">
    <input id="payment_method" type="hidden">
    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

    <button id="card-button" data-secret="{{ $intent->client_secret }}">
        Update Payment Method
    </button>
</form>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
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
            console.log(error)
        } else {
            // The card has been verified successfully...
            console.log("SUCCESS")
            paymentMethodHandler(setupIntent.payment_method);
        }
    });

    function paymentMethodHandler(payment_method) {
        console.log(payment_method);
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.getElementById('payment_method');
        hiddenInput.setAttribute('value', payment_method);
    }
</script>
