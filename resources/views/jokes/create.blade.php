@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('leftMenu')
      <div class="col-md-8 ">
        <div class="panel panel-default">
          <div class="panel-heading">Add Jokes</div>

          <div class="panel-body">
            <div class="alert alert-warning">
              Your can add {{ $user->plan->limit->limit - $user->jokes->count() }} Joke(s).
            </div>
            <form action="{{route('joke.store')}}" method="post">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="title" class="col-md-4 control-label">Joke Title</label>

                <div class="col-md-6">
                  <input id="joke_title" type="text" class="form-control" name="title"
                         required>
                </div>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label for="title" class="col-md-4 control-label">Joke Body</label>

                <div class="col-md-6">
                  <textarea id="joke_title" type="text" class="form-control" name="body"
                            required></textarea>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">Add Joke</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
