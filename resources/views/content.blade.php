@extends('masterUser')

@section('contentHeader')
<div class="hero" style="background: #10151e;">
  <div class="image">
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
                background-repeat:no-repeat;display: flex; float: right">
    </div>
  </div>
</div>
@endsection


@section('content')
<div id="app">
  <br>
  <h2 id="title">{{ $movies->movieTitle }}</h2>
  <iframe width="100%" height="600" src="{{ $movies->movieTrailer }}" frameborder="0" allowfullscreen></iframe>
</div>
<div id="createBooking">
  <h2 id="title">Направи резервация</h2>
  <form action="/create" method="post" id="form1">
    @csrf
    <div class="form-inline">
      <label for="dateSelected">Дата: </label>
      <select class="form-control" name="dateSelected" id="dateSelected" onchange="window.history.pushState(null, null,this.value);">
        <option disabled selected value> -- Изберете дата -- </option>
        @foreach ($moviedate as $date)
        <option value="{{ url('content/'.$movies->movieId.'/'.$date->date.'/') }}" @if($reqDate==$date->date) selected @endif>{{ $date->date}}</option>
        @endforeach
      </select>
    </div>
    <div id="Selecteed">
      @if($movietime)
      <p id="label2D">2D </p>
      @endif
      @foreach ($movietime as $time)
      <button type="button" value="{{ url('content/'.$movies->movieId.'/'.$reqDate.'/'.$time->time.'/') }}" class="btnTime" type="button" onclick="window.history.pushState(null, null,this.value);timeButton('{{$time->time}}','{{ $time->date}}')" id="2DTheater">{{$time->time}}</button>
      @endforeach
      <p id="label3D">3D </p>
      @foreach ($movietimee as $time)
      <button type="button" value="{{ url('content/'.$movies->movieId.'/'.$reqDate.'/'.$time->time.'/') }}" class="btnTime" type="button" onclick="window.history.pushState(null, null,this.value);timeButton('{{$time->time}}','{{ $time->date}}')" id="3DTheater">{{$time->time}}</button>
      @endforeach
      <p id="myPara"></p>
      <div class="form-row">

        <div class="form-group col-md-5">
          <label for="firstname">Име</label>
          <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Име">
        </div>
        <div class="form-group col-md-5">
          <label for="lastname">Фамилия</label>
          <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Фамилия">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-10">
          <label for="email">Имейл</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Имейл">
        </div>
      </div>
      <label for="ticknum">Брой билети</label>
      <div class="form-inline">
        <div class="form-group">
          <input type="text" class="form-control" name="ticknum" id="ticknum" onkeyup="getTicketNum(this)" placeholder="Брой билети">
        </div>
        <button disabled type="button" id="chooseBtn" class="btn btn-secondary" data-toggle="modal" data-target="#a">Избор на място</button>
        <div class="form-group">
          <input type="hidden" class="form-control" name="MovieId" id="MovieId" value="{{ $movies->movieTitle }}">
        </div>
      </div>
      <div class="modal fade" id="a" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Изберете си място</h4>
            </div>
            <div class="modal-body">
              <div class="container" id="UserContainer">
                <ul class="showcase">
                  <li>
                    <div class="seat"></div>
                    <small>Свободно</small>
                  </li>
                  <li>
                    <div class="seatSelected"></div>
                    <small>Избрано</small>
                  </li>
                  <li>
                    <div class="seatSold"></div>
                    <small>Продадено</small>
                  </li>
                </ul>
                <div class="screenDiv">
                  <div class="screen"></div>
                </div>
                @foreach(range('A','G') as $v)
                <div class="row">
                  @for($i=1;$i < 10; $i++) <div id="{{$i}}{{$v}}" value="{{$i}}{{$v}}" onClick="reply_click(this.id)" class="seat">{{$i}}{{$v}}
                </div>
                @endfor
              </div>
              @endforeach
            </div>
          </div>
          <div class="modal-footer">
            <div class="form-group">
              <label for="ticknum">Места</label>
              <input type="text" class="form-control" name="places" id="places" placeholder="Места">
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(isset($date->date)&& (isset($time->time)))
    <div class="form-group">
      <input type="hidden" class="form-control" name="datte" id="datte" value="{{$reqDate}}">
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="timee" id="timee" value="{{$time->time}}">
    </div>
    @endif
</div>
<div id="selectedSeats">
  <input type="hidden" class="form-control" name="seatSold" id="seatSold" value="@foreach ($seatSold as $seat){{$seat->places}} @endforeach">
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
</form>
<button type="submit" id="submitForm" form="form1" class="btn btn-primary">Резервирай</button>

</div>
<script src="{{ asset('js/menu.js') }}" defer></script>



@endsection