@extends('master')

@section('content')
<form action="/admin/createMovieDate" method="post">
  @csrf
  <div class="form-group">
    <label for="timeSelected">Филм</label>
    <select name="timeSelected" onchange="window.location.href=this.value;">
      <option disabled selected value> -- Изберете филм -- </option>
      @foreach ($movies as $movie)
      <option value="{{ url('admin/addMovieDate/'. $movie->movieTitle) }}" @if($reqTitle==$movie->movieTitle) selected @endif>{{$movie->movieTitle}}</option>
      @endforeach
    </select>
  </div>
  @if(isset($movietitle->movieId)&& (isset($movie->movieTitle)))
  <div class="form-group">
    <input type="hidden" class="form-control" name="MovieId" id="MovieId" value="{{$movietitle->movieId}}">
  </div>
  <div class="form-group">
    <input type="hidden" class="form-control" name="movieTitle" id="movieTitle" value="{{$reqTitle}}">
  </div>
  @endif
  <div class="form-group">
    <label for="time">Час</label>
    <input type="text" class="form-control" name="time" id="time" placeholder="Час">
  </div>
  <div class="form-group">
    <label for="date">Дата</label>
    <input type="date" class="form-control" name="date" id="date" placeholder="date">
  </div>
  <select name="type" onchange="changeType(this.value);">
    <option disabled selected value> -- Изберете тип -- </option>
    <option value="2D">2D</option>
    <option value="3D">3D</option>
  </select>
  <input type="text" class="form-control" name="Typ" id="Typ" >
  <button type="submit" class="btn btn-primary">Submit</button>
  <p id="myPara"></p>

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