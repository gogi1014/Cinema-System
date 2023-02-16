@extends('masterUser')

@section('content')
<form action="{{ url('/') }}" method="GET">
  <input type="text"  name="search" required />
  <button type="submit">Search</button>
</form>

@foreach ($moviedate as $movieDate)
{{ $movieDate->date }}
@endforeach


<div class="form-group">
  <label for="timeSelected">Категория</label>
  <select name="timeSelected">
    <option disabled selected value> -- Изберете категория -- </option>
    @foreach ($moviesAll as $movie)
    <option value="{{ url('/') }}">{{$movie->movieCat}}</option>
    @endforeach
  </select>
</div>

<div id="app">
  <table id="tableContent">

    @foreach ($movies as $movie)
    <tr class='trMovie'>
      <td data-toggle="modal" data-target="#a{{ $movie->movieId }}"><img width="250px" height="315px" src="{{ $movie->movieImg }}"></td>
      <td class='trMovie'>
        <table>
          <tr>
            <td>
              <h4><a style="text-decoration:none" href="{{ url('content/'.$movie->movieId) }}" style="cursor:pointer;">{{ $movie->movieTitle }}</a></h4>
            </td>
          </tr>
          <tr>
            <td>{{ $movie->movieGenre }} | {{ $movie->movieDuration }} мин. | Категория: {{ $movie->movieCat }} | {{ $movie->movieLan }}</td>
          </tr>
        </table>
      </td>
      <td>
        <!-- Modal -->
        <div class="modal fade" id="a{{ $movie->movieId }}" role="dialog">
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
                {{ $movie->movieGenre }} | {{ $movie->movieDuration }} мин. | Категория: {{ $movie->movieCat }} | {{ $movie->movieLan }}
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
<div id="MovTrailers">
  <h2>Трейлъри</h2>
  <div class="grid">
    @foreach ($moviesTrailer as $movie)
    <div class="grid-item"><iframe width="420" height="315" src="{{ $movie->movieTrailer }}" frameborder="0" allowfullscreen></iframe></div>
    @endforeach
  </div>
</div>
<div id="MovSoon">
  <h2>Очаквайте</h2>
  <div class="container">
    @foreach ($moviesSoon as $movie)
    <div class="mySlides">
      <img src="{{ $movie->movieImg }}" width="250px" height="315px">
      <div class="text">{{ $movie->movieTitle }}</div>
    </div>
    @endforeach
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
</div>
@endsection