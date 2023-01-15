<!DOCTPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
<script src="https://unpkg.com/laravel-vue-pagination@2.3.1/dist/laravel-vue-pagination.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/vue@3"></script>
<script src="https://unpkg.com/vue@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>  
<script src="https://unpkg.com/vuesax@4.0.1-alpha.16/dist/vuesax.min.js"></script>
<title>View Student Records</title>
</head>
<body>

<form action="{{ url('/') }}" method="GET">
  <input type="text" name="search" required />
  <button type="submit">Search</button>
</form>


 



<div id="app">
    <table border = "1">
    @foreach ($movies as $movie)
    <tr>
    <td data-toggle="modal" data-target="#{{ $movie->movieTitle }}"><img width="300" height="315" src="{{ $movie->movieImg }}"></td>  
    <td><a href="{{ url('content/'.$movie->movieId) }}" style="cursor:pointer;">{{ $movie->movieTitle }}</a></td>
    <td>{{ $movie->movieGenre }}</td>
    <td>{{ $movie->movieDuration }}</td>
    <td>{{ $movie->movieCat }}</td>
    <td>{{ $movie->movieLan }}</td>
    <td>
    <!-- Modal -->
    <div class="modal fade" id="{{ $movie->movieTitle }}" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ $movie->movieTitle }}</h4>
          </div>
          <div class="modal-body">
            <iframe width="420" height="315" src="{{ $movie->movieTrailer }}" frameborder="0" allowfullscreen></iframe>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    </td>
    </tr>
    @endforeach
    </table>    
</div>
<div class="d-felx justify-content-center">
  <ul class='pagination pagination-sm'>
    {{$movies->appends($_GET)->links('pagination::bootstrap-4')}}
  </ul>
</div>


</body>
</html>