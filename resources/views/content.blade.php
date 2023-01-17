<!DOCTPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>    

<title>View Student Records</title>
</head>
<body>




<div id="app">

    <table border = "1">
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
    <label for="date">Дата</label>
    <input type="date" class="form-control" name="date" id="date" placeholder="Дата">
  </div>
  <div class="form-group">
    <label for="ticknum">Брой билети</label>
    <input type="text" class="form-control" name="ticknum" id="ticknum" placeholder="Брой билети">
  </div>
  <div class="form-group">
    <label for="time">Час</label>
    <input type="text" class="form-control" name="time" id="time" placeholder="Час">
  </div>
  <select name="user">
    @foreach ($array = explode(',', $movies->time) as $movie)
    <option value="{{ $movie }}">{{ $movie}}</option>
    @endforeach
    </select>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>