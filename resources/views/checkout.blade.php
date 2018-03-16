@extends('layouts.master')

@section('title')
Checkout
@endsection

@section('extra-content')
<script src="https://js.stripe.com/v3/"></script>
<style>
        /**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
.StripeElement {
background-color: white;
height: 40px;
padding: 10px 12px;
border-radius: 4px;
border: 1px solid transparent;
box-shadow: 0 1px 3px 0 #e6ebf1;
-webkit-transition: box-shadow 150ms ease;
transition: box-shadow 150ms ease;
}

.StripeElement--focus {
box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
border-color: #fa755a;
}

.StripeElement--webkit-autofill {
background-color: #fefde5 !important;
}
</style>
@endsection

@section('content')
<div class="panel-body">


 <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <form>
                        <fieldset>
                            <legend>Shipping Information:</legend>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="firstName"> Full Name </label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Please enter first name">
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="Please enter email">
                                    </div>
                                   
                                </div>

                            <div class="form-group">
                                <label for="firstName">Address1 </label>
                                <textarea class="form-control" id="firstName" placeholder="Please enter address1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="firstName">Address2 </label>
                                <textarea class="form-control" id="firstName" placeholder="Please enter address2"></textarea>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="firstName">State </label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Please enter state">
                                </div>
                                <div class="col-md-6">
                                    <label for="firstName">City </label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Please enter city">
                                </div>
                            </div>
                            </fieldset>
                    </form>

                    <form action="/charge" method="post" id="payment-form">
                        <legend>Billing Information:</legend>
                                <div class="form-row">
                                                <label for="firstName"> Name on Card </label>
                                                <input type="text" class="form-control" id="firstName" placeholder="Please enter  name"><br>
                                    <label for="card-element">
                                    Credit or debit card
                                    </label>
                                    <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
    
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    Sign me up to newsletters and other exclusive shit.
                                </label>
                            </div>
                            <a class="btn btn-default">Submit</a>
                        </fieldset>
                    </form>

                    <form action="your-server-side-code" method="POST">
                            <script
                              src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                              data-key="pk_test_XLwttzuRw55LVshugJMgLZ4k"
                              data-amount="999"
                              data-name="Demo Site"
                              data-description="Example charge"
                              data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                              data-locale="auto">
                            </script>
                    </form>
                    
                </div>
            </div>
        </div>
    </section><br><br>
    
    </form>
    
    @foreach(Cart::instance('shopping')->content() as $row)
    <div class="row">
        <div class="col-xs-2"><img class="img-responsive" src="/storage/product_images/{{ $row->model->imagePath }}">
        </div>
        <div class="col-xs-4">
            <h4 class="product-name"><strong>{{ $row->name }}</strong></h4>
            <h4><small>{{ $row->model->description }}</small></h4>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-6 text-right">
                <h6><span class="text-muted">$</span><strong>{{ $row->subtotal }} </strong></h6>
            </div>


        </div>
    </div>
    <hr>
    @endforeach
        <div class="row text-center">
            <div class="col-xs-9">
                <h4 class="text-left">Total <strong><br>
{{ presentPrice(Cart::total()) }}</strong></h4>
            </div>


        </div>
    @endsection

    @section('extra-content-bottom')
    <script>
    
    // Create a Stripe client.
var stripe = Stripe('pk_test_XLwttzuRw55LVshugJMgLZ4k');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
    </script>
    @endsection