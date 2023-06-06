@extends('master')

@section('content')
<form action="createMovie" method="post">
  @csrf
  <div class="container" id="addMovieCont">
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieImg">Постер</label>
        <input type="text" class="form-control" name="movieImg" id="movieImg" placeholder="Постер">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieTitle">Заглавие</label>
        <input type="text" class="form-control" name="movieTitle" id="movieTitle" placeholder="Заглавие">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieTrailer">Трейлър</label>
        <input type="text" class="form-control" name="movieTrailer" id="movieTrailer" placeholder="Заглавие">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieGenre">Жанр</label>
        <input type="text" class="form-control" name="movieGenre" id="movieGenre" placeholder="Жанр">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="movieDuration">Времетраене</label>
        <input type="number" class="form-control" name="movieDuration" id="movieDuration" placeholder="Времетраене">
      </div>
      <div class="form-group col-md-5">
        <label for="movieRelDate">Дата на излизане</label>
        <input type="date" class="form-control" name="movieRelDate" id="movieRelDate" placeholder="Дата на излизане">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieDirector">Режисьор</label>
        <input type="text" class="form-control" name="movieDirector" id="movieDirector" placeholder="Режисьор">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieActors">Актъори</label>
        <input type="text" class="form-control" name="movieActors" id="movieActors" placeholder="Актъори">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="Description">Описание</label>
        <textarea rows="5" cols="60" type="text" class="form-control" name="Description" id="Description" placeholder="Описание"></textarea>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-10">
        <label for="movieLan">Език</label>
        <input type="text" class="form-control" name="movieLan" id="movieLan" placeholder="Език">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="movieCat">Категория</label>
        <input type="text" class="form-control" name="movieCat" id="movieCat" placeholder="Категория">
      </div>
      <div class="form-group col-md-5">
        <label for="active">Активен</label>
        <input type="number" class="form-control" name="active" id="active" placeholder="Активен">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
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