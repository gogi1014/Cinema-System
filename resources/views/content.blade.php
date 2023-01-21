<!DOCTPE html>
  <html>

  <head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <title>View Student Records</title>
  </head>

  <body>
    <div id="app">

      <table border="1">
        <tr>
          <td></td>
          <td>First Name</td>
          <td>Last Name</td>
          <td>City Name</td>
          <td>Email</td>
        </tr>
        <td><img width="300" height="315" src="{{ $movies->movieImg }}"></td>
        <td>{{ $movies->movieTitle }}</td>
        <td>{{ $movies->movieGenre }}</td>
        <td>{{ $movies->movieDuration }} мин.</td>
        <td>{{ $movies->movieCat }}</td>
        <td>{{ $movies->movieLan }}</td>
        <td>{{ $movies->time }}</td>
        </tr>
      </table>
    </div>

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
        <input type="hidden" class="form-control" name="datte" id="datte" value = "{{$date->date}}">
      </div>
      <div class="form-group">
        <input type="hidden" class="form-control" name="timee" id="timee" value = "{{$time->time}}">
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

  </body>

  </html>