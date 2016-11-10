@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('leftMenu')
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Add Payment Details</div>

          <div class="panel-body">
            <form id="checkout" method="post" action="/subscribe">
              <div id="payment-form"></div>
              {{ csrf_field() }}
              <input type="submit" value="Continue plan {{ $plan->name }} ({{$plan->amount}})"
                     class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>

    @endsection

    @section('scripts')
      <script src="https://js.braintreegateway.com/js/braintree-2.29.0.min.js"></script>
      <script>
        // We generated a client token for you so you can test out this code
        // immediately. In a production-ready integration, you will need to
        // generate a client token on your server (see section below).
        var clientToken = '{{ $clientToken }}';

        braintree.setup(clientToken, "dropin", {
          container: "payment-form"
        });
      </script>
@endsection