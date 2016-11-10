@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('leftMenu')
      <div class="col-md-8 ">
        <div class="panel panel-default">
          <div class="panel-heading">Your Jokes <a href="{{route('joke.create')}}">
              <button class="btn btn-primary">Add Jokes</button>
            </a></div></div>

          <div class="panel-body">
            <ul class="list-group">
              @forelse($user->jokes as $joke)
                <li class="list-group-item">
                  <h4> {{ $joke->title }}</h4>
                  <p>{{ $joke->body }}</p>
                  <a href="{{route('joke.destroy', $joke->id)}}">
                    <form action="{{route('joke.destroy', $joke->id)}}" method="POST">
                      {{csrf_field()}}
                      <input type="hidden" name="_method" value="DELETE">
                      <button class="btn btn-danger">Delete</button>
                    </form>
                  </a>
                </li>
              @empty
                <li class="list-group-item">No jokes please add one.</li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
