@extends('masterUser')

@section('contentHeader')
<div class="hero" style="  background: #10151e;">
  <div class="image" >
    <div class="section">
      <h1>{{ $movies->movieTitle }}</h1>
      <table id="dAt">
        <tr>
          <th>Дата на премиера </th>
          <th>Времетраене </th>
        </tr>
        <tr>
          <td>{{ $movies->movieRelDate }}</td>
          <td>{{ $movies->movieDuration }} мин.</td>
        </tr>
      </table>
      <h3>Описание</h3>
      <div>
        {{ $movies->Description }}
      </div>
            <table id="contentTable">
              <tr>
                <th>Жанр: </th>
                <td>{{$movies->movieGenre}}</td>
              </tr>
              <tr>
                <th>Актьори: </th>
                <td>{{$movies->movieActors}}</td>
              </tr>
              <tr>
                <th>Режисьор: </th>
                <td>{{$movies->movieDirector}}</td>
              </tr>
              <tr>
                <th>Оригинално аудио: </th>
                <td>{{$movies->movieLan}}</td>
              </tr>
              <tr>
                <th>Категория: </th>
                <td>{{$movies->movieCat}}</td>
              </tr>
            </table>
    </div>
    <div class="section" style="background:linear-gradient(to right, rgba(16, 21, 30, 1),rgba(16, 21, 30, 0.95), rgba(16, 21, 30, 0.25), rgba(16, 21, 30, 0.2)),url({{$movies->movieImg}});
                background-repeat:no-repeat;display: flex;width:100%; float: right">
    </div>
  </div>
</div>
@endsection


@section('content')

<div id="app">

  <h2 id="title">{{ $movies->movieTitle }}</h2>
  <iframe width="100%" height="600" src="{{ $movies->movieTrailer }}" frameborder="0" allowfullscreen></iframe>
</div>
<div id="createBooking">
  <h2 id="title">Направи резервация</h2>
  <form action="/create" method="post">
    @csrf
    <div class="form-group">
      <label for="dateSelected">Дата</label>
      <select name="dateSelected" id="dateSelected" onchange="window.location.href=this.value;">
        <option disabled selected value> -- Изберете дата -- </option>
        @foreach ($moviedate as $date)
        <option value="{{ url('content/'.$movies->movieId.'/'.$date->date) }}" @if($reqDate==$date->date) selected @endif>{{ $date->date}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="timeSelected">Час</label>
      <select name="timeSelected">
        <option disabled selected value> -- Изберете час -- </option>
        @foreach ($movietime as $time)
        <option value="{{$time->time}}" @if($reqTime==$time->time) selected @endif>{{ $time->time}}</option>
        @endforeach
      </select>
    </div>
    @if(isset($date->date)&& (isset($time->time)))
    <div class="form-group">
      <input type="hidden" class="form-control" name="datte" id="datte" value="{{$date->date}}">
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="timee" id="timee" value="{{$time->time}}">
    </div>
    @endif
    <div class="form-group">
      <input type="hidden" class="form-control" name="MovieId" id="MovieId" value="{{ $movies->movieTitle }}">
    </div>
    <div class="form-group">
      <label for="firstname">Име</label>
      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Име">
    </div>
    <div class="form-group">
      <label for="lastname">Фамилия</label>
      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Фамилия">
    </div>
    <div class="form-group">
      <label for="email">Имейл</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="Имейл">
    </div>
    <div class="form-group">
      <label for="ticknum">Брой билети</label>
      <input type="text" class="form-control" name="ticknum" id="ticknum" placeholder="Брой билети">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

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

<script>
$('div.section:empty').hide();

</script>