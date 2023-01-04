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
    <td>Id</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>City Name</td>
    <td>Email</td>
    </tr>
    @foreach ($movies as $movie)
    <tr>
    <td>{{ $movie->movieTitle }}</td>
    <td>{{ $movie->movieDuration }}</td>
    <td>{{ $movie->movieRelDate }}</td>
    <td>{{ $movie->movieDirector }}</td>
    </tr>
    @endforeach
    </table>
  </div>  

  <script>  
    var app = new Vue({  
      el: '#app',  
      data: {  
        message: 'Vue.js second example with CDN'  
      }  
    })  
  </script>  


</body>
</html>