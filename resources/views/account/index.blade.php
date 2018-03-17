@extends('layouts.app')

@section('content')

<div class="container">
                   <div class="panel-heading"><h4>Account</h4></div>

<div class="panel-body">

 <p>Fund Advertiser Account. Minimum $5.00.</p>

<form class="form-horizontal" role="form" method="POST" action="/charge">                                 
                        {{ csrf_field() }}
                        <div class="form-group">


      </div>

                        <div class="form-group">

                            <label for="email" class="col-md-4 control-label">Amount:</label>

                            <div class="col-md-6">
                                <input id="amount" type="amount" class="form-control" name="amount" value="" required autofocus>

                                                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <input type ='hidden' id="stripeToken" name="stripeToken" />
                                <button type="submit" name ="fundButton" id="fundButton" class="btn btn-primary">
                                    Fund Account
                                </button>

                            </div>
                        </div>
                    </form>

<hr>
 <p>User ID: {{$id}} </p>
 <p>API Key: {{$api_key}} </p>
 <p>API URL: <a href="{{$api_url}}/api/publisher_reports?user_id={{$id}}&publisher_api_key={{$api_key}}&date={{$todays_date}}">{{$api_url}}/api/publisher_reports?user_id={{$id}}&publisher_api_key={{$api_key}}&date={{$todays_date}}</a> </p>



    </p>



<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
$('#fundButton').on('click', function(e) {
  e.preventDefault();

  $('#error_explanation').html('');

  var amount = $('input#amount').val();
  amount = amount.replace(/\$/g, '').replace(/\,/g, '')

  amount = parseFloat(amount);

  if (isNaN(amount)) {
    $('#error_explanation').html('<p>Please enter a valid amount in USD ($).</p>');
  }
  else if (amount < 5.00) {
    $('#error_explanation').html('<p>Amount must be at least $5.</p>');
  }
  else {
    amount = amount * 100; // Needs to be an integer!
    handler.open({
      amount: Math.round(amount)
    })
  }
});

var handler = StripeCheckout.configure({
  key: 'pk_live_aruhZ69jhLe94zNRjKz70Rjk',
  locale: 'auto',
  name: 'Liberty Ads Account',
  description: 'One-time payment',
  token: function(token) {
    //alert(token.id);
    //alert($('input#stripeToken'));
    $('input#stripeToken').val(token.id);
    $('form').submit();
  }
});
</script>




@stop
