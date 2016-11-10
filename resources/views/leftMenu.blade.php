<div class="col-md-4">
  <ul class="list-group">
    @if($user->onTrial() && !$user->subscribed(\App\SubscriptionPlan::MAIN_SUBSCRIPTION))
      <li class="list-group-item">
        <a href="{{route('paymentDetails')}}">Payment Details</a>
      </li>
    @endif

    @if($user->subscribed(\App\SubscriptionPlan::MAIN_SUBSCRIPTION))
      <li class="list-group-item">
        <a href="{{route('premium')}}">Enjoy Premium Zone</a>
      </li>
      <li class="list-group-item">
        <a href="{{route('joke.index')}}">Jokes</a>
      </li>
    @endif
  </ul>
</div>