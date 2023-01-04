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
    <td>{{ $movies->movieImg }}</td>  
    <td>{{ $movies->movieTitle }}</td>
    <td>{{ $movies->movieGenre }}</td>
    <td>{{ $movies->movieDuration }}</td>
    <td>{{ $movies->movieCat }}</td>
    <td>{{ $movies->movieLan }}</td>
    </tr>
    </table>    
</div>

<form action="/create" method="post">
  @csrf
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Age">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Address">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>