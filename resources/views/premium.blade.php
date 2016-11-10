@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('leftMenu')
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Enjoy Premium Features as per your plan</div>

          <div class="panel-body">
            <ul class="list-group">
              @foreach($plans as $plan)
                <li class="list-group-item {{ $user->subscribedToPlan($plan->plan_id, \App\SubscriptionPlan::MAIN_SUBSCRIPTION) ?'active' :'' }}">
                  @if($user->subscribedToPlan($plan->plan_id, \App\SubscriptionPlan::MAIN_SUBSCRIPTION))

                    <div class="alert alert-success">
                      <b>{{ $plan->name }}</b>
                        <h4>You can add upto {{$plan->limit->limit}}  Joke(s)</h4>

                        <p class="label label-default">This is your active plan</p>
                    </div>

                    <a href="{{route('cancel')}}">
                      <button class="btn btn-danger">Cancel Subscription</button>
                    </a>
                  @else
                    <div>
                      <b>{{ $plan->name }}</b>
                      <h5>You can add upto {{$plan->limit->limit}}  Joke(s)</h5>
                    </div>
                    <a href="{{route('switch')}}?plan={{$plan->plan_id}}">
                      <button class="btn btn-primary">
                        Switch to this Plan
                      </button>
                    </a>
                  @endif


                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

@endsection
