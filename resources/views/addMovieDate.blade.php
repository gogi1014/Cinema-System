@extends('master')

@section('content')

<form action="/createMovieDate" method="post">
  @csrf
  <div class="form-group">
    <label for="MovieName">Name</label>
    <input type="text" class="form-control" name="MovieId" id="MovieId" placeholder="MovieId">
  </div>
  <div class="form-group">
    <label for="MovieName">Name</label>
    <input type="text" class="form-control" name="MovieName" id="MovieName" placeholder="MovieName">
  </div>
  <div class="form-group">
    <label for="movieTitle">Age</label>
    <input type="text" class="form-control" name="time" id="time" placeholder="time">
  </div>
  <div class="form-group">
    <label for="movieGenre">Address</label>
    <input type="date" class="form-control" name="date" id="date" placeholder="date">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection