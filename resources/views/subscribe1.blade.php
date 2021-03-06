<link rel="stylesheet" href="{{asset('css/app.css')}}">
<div class="container">
    <div class="row justify-content-center align-content-center h-100">
        <div class="card col-md-4 h-auto p-0 m-0">
            <form id="subscribe-form" method="POST" action="{{route('subscribe.user')}}" onSubmit="return false"
                  class="form p-2 m-0">
                <div class="card-header">
                    <h1 class="text-center">Subscribe</h1>
                </div>
                <div class="card-body">
                    @csrf
                    {{--                @foreach($plans as $plan)--}}
                    {{--                    <div class="col-md-4">--}}
                    {{--                        <div class="form-check form-check-inline">--}}
                    {{--                            --}}{{--                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"--}}
                    {{--                            --}}{{--                                   value="option1">--}}
                    {{--                            --}}{{--                            <label class="form-check-label" for="inlineRadio1">1</label>--}}
                    {{--                            <input type="radio" class="form-check-input" id="plan" name="plan" value='{{$plan->id}}'>--}}
                    {{--                            <label class="form-check-label">{{$plan->product->name}}--}}
                    {{--                                - USD {{$plan->amount/100}}</label>--}}
                    {{--                            --}}{{--                            <span--}}
                    {{--                            --}}{{--                                class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>--}}
                    {{--                            --}}{{--                            <span class="plan-name">{{$plan->product->name}}</span>--}}
                    {{--                            --}}{{--                            </label>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                @endforeach--}}
                    <input id="card-holder-name" type="text" class="form-control mb-4" placeholder="Card Holder Name">
                    <input id="payment_method" type="hidden" name="payment_method">
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control"></div>
                </div>
                <div class="card-footer">
                    <button id="card-button" class="btn btn-primary w-100" data-secret="{{ $intent->client_secret }}">
                        Subscribe
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<script src="https://js.stripe.com/v3/"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

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

        form.submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{route('subscribe.user')}}",
                type: "POST",
                data: {
                    plan: form.getAttribute('plan'),
                    payment_method: payment_method,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    console.log('Ajax S');
                    console.log(response);
                    if (response) {
                        console.log(response.success())
                    }
                },
                error: function (response) {
                    console.log('Ajax E');
                    console.log(response);
                }
            });
        });
    }
</script>
