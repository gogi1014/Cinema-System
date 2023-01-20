@extends('master')

@section('content')

<form action="/createMovie" method="post">
  @csrf
  <div class="form-group">
    <label for="movieImg">Name</label>
    <input type="text" class="form-control" name="movieImg" id="movieImg" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="movieTitle">Age</label>
    <input type="text" class="form-control" name="movieTitle" id="movieTitle" placeholder="Age">
  </div>
  <div class="form-group">
    <label for="movieGenre">Address</label>
    <input type="text" class="form-control" name="movieGenre" id="movieGenre" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="movieDuration">Address</label>
    <input type="number" class="form-control" name="movieDuration" id="movieDuration" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="movieRelDate">Address</label>
    <input type="date" class="form-control" name="movieRelDate" id="movieRelDate" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="movieDirector">Address</label>
    <input type="text" class="form-control" name="movieDirector" id="movieDirector" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="movieActors">Address</label>
    <input type="text" class="form-control" name="movieActors" id="movieActors" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="Description">Address</label>
    <input type="text" class="form-control" name="Description" id="Description" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="movieLan">Address</label>
    <input type="text" class="form-control" name="movieLan" id="movieLan" placeholder="Address">
  </div>
  <div class="form-group">
    <label for="movieCat">Address</label>
    <input type="text" class="form-control" name="movieCat" id="movieCat" placeholder="Address">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection