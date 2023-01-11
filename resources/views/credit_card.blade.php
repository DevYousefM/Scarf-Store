<!DOCTYPE html>
<html>

<head>
    <title>zahra store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

    @include('layouts.header')
    <div class="container login">
        <h1 class="heading" style="margin-top: 8rem;"><span>Checkout</span> </h1>
        <div class="row" style="justify-content: center;">
            <div class="col-md-12">
                <div class="panel panel-default credit-card-box">

                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total }}">
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Phone Number* <em>(To receive an order confirmation
                                    call)</em></label>
                            <input autocomplete='off' class='form-control' value="{{ old('phone') }}" name="phone"
                                size='11' type='number'>
                            @error('phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Delivary address*</label>
                            <input autocomplete='off' class='form-control' value="{{ old('address') }}" name="address"
                                size='11' type='text'>
                            @error('address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number*</label> <input autocomplete='off'
                                class='form-control card-number' size='20' type='text'>
                        </div>

                        <div style="width:100%;">
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC*</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month*</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year*</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>

                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                        <div style="display: flex;flex-wrap:wrap;justify-content:space-around;width:100%">
                            @foreach ($products as $item)
                                <div class="pco">
                                    <div style="height: 100%;width:90px;overflow:hidden">
                                        <img style="width: 100%" src="{{ asset("$item->image") }}">
                                    </div>
                                    <div style="display: flex;flex-direction:column;margin-left:10px">
                                        <span>{{ $item->title }}</span>
                                        <span>${{ $item->price }} * {{ $item->qtn }} =
                                            ${{ $item->price * $item->qtn }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="display: flex;flex-direction:column">
                                <em style="width:100%;text-align:center;margin:0;color:var(--pink);font-weight:700">
                                    Total Cost: {{ $total }}$</em>
                                <button class="btn " type="submit">Pay Now
                                    (${{ $total }})</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript" src="{{ asset('js/payment.js') }}"></script>

</html>
