@extends('master')

@section('content')

<form action="/createMovie" method="post">
  @csrf
  <div class="form-group">
    <label for="movieImg">Постер</label>
    <input type="text" class="form-control" name="movieImg" id="movieImg" placeholder="Постер">
  </div>
  <div class="form-group">
    <label for="movieTitle">Заглавие</label>
    <input type="text" class="form-control" name="movieTitle" id="movieTitle" placeholder="Заглавие">
  </div>
  <div class="form-group">
    <label for="movieTrailer">Трейлър</label>
    <input type="text" class="form-control" name="movieTrailer" id="movieTrailer" placeholder="Заглавие">
  </div>
  <div class="form-group">
    <label for="movieGenre">Жанр</label>
    <input type="text" class="form-control" name="movieGenre" id="movieGenre" placeholder="Жанр">
  </div>
  <div class="form-group">
    <label for="movieDuration">Времетраене</label>
    <input type="number" class="form-control" name="movieDuration" id="movieDuration" placeholder="Времетраене">
  </div>
  <div class="form-group">
    <label for="movieRelDate">Дата на излизане</label>
    <input type="date" class="form-control" name="movieRelDate" id="movieRelDate" placeholder="Дата на излизане">
  </div>
  <div class="form-group">
    <label for="movieDirector">Режисьор</label>
    <input type="text" class="form-control" name="movieDirector" id="movieDirector" placeholder="Режисьор">
  </div>
  <div class="form-group">
    <label for="movieActors">Актъори</label>
    <input type="text" class="form-control" name="movieActors" id="movieActors" placeholder="Актъори">
  </div>
  <div class="form-group">
    <label for="Description">Описание</label>
    <input type="text" class="form-control" name="Description" id="Description" placeholder="Описание">
  </div>
  <div class="form-group">
    <label for="movieLan">Език</label>
    <input type="text" class="form-control" name="movieLan" id="movieLan" placeholder="Език">
  </div>
  <div class="form-group">
    <label for="movieCat">Категория</label>
    <input type="text" class="form-control" name="movieCat" id="movieCat" placeholder="Категория">
  </div>
  <div class="form-group">
    <label for="active">Активен</label>
    <input type="number" class="form-control" name="active" id="active" placeholder="Активен">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@endsection