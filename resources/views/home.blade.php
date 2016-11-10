@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('leftMenu')
      <div class="col-md-8 ">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>

          <div class="panel-body">
            You have subscribed to {{ $plan->name }}
            <p>{{ $plan->descriptions }}</p>

            <hr>
            <a href="{{route('joke.create')}}">
              <button class="btn btn-primary">Add Jokes</button>
            </a></div>
        </div>
      </div>
    </div>
  </div>
@endsection
