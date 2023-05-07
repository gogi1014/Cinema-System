@extends('master')

@section('content')
<form action="/admin/createMovieDate" method="post">
  @csrf
  <div class="form-inline">
    <label for="timeSelected">Филм</label>
    <select id="sortElements" class="form-control" name="timeSelected" onchange="window.location.href=this.value;">
      <option disabled selected value> -- Изберете филм -- </option>
      @foreach ($movies as $movie)
      <option value="{{ url('admin/addMovieDate/'. $movie->movieTitle) }}" @if($reqTitle==$movie->movieTitle) selected @endif>{{$movie->movieTitle}}</option>
      @endforeach
    </select>
    @if(isset($movietitle->movieId)&& (isset($movie->movieTitle)))
    <div class="form-group">
      <input type="hidden" name="MovieId" id="MovieId" value="{{$movietitle->movieId}}">
    </div>
    <div class="form-group">
      <input type="hidden" name="movieTitle" id="movieTitle" value="{{$reqTitle}}">
    </div>
    @endif
  </div>
  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="time">Час</label>
      <input type="text" class="form-control" name="time" id="time" placeholder="Час">
    </div>
    <div class="form-group col-md-5">
      <label for="date">Дата</label>
      <input type="date" class="form-control" name="date" id="date" placeholder="date">
    </div>
  </div>
  <div class="form-inline">
    <select class="form-control" name="type" onchange="changeType(this.value);">
      <option disabled selected value> -- Изберете тип -- </option>
      <option value="2D">2D</option>
      <option value="3D">3D</option>
    </select>
  </div>
  <input type="hidden" class="form-control" name="Typ" id="Typ">
  <p id="myPara"></p>
  <button type="submit" class="btn btn-primary">Създай</button>
</form>
<script src="{{ asset('js/menu.js') }}" defer></script>
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