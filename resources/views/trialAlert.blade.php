@if(isset($user) && $user->onGenericTrial())
  <div class="alert alert-warning">You are on Trial Period of {{ $plan->name }}.
    Your trial ends within {{ $user->trial_ends_at->diffForHumans() }}
    <br>
    Please Enter your <a href="{{route('paymentDetails')}}">payment details</a>
  </div>
@endif