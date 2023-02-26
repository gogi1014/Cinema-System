@extends('masterUser')

@section('content')
<form action="{{ url('/') }}" method="GET">
  <input type="text"  name="search" required />
  <button type="submit">Search</button>
</form>

@foreach ($moviedate as $movieDate)
{{ $movieDate->date }}
@endforeach

<form name="comboboxFilter" action="{{ url('/') }}" method="GET">
<div class="form-group">
  <label for="category">Категория</label>
  <select name="category" onChange="comboboxFilter.submit();">
    <option disabled selected value> -- Изберете категория -- </option>
    @foreach ($moviesAll as $movie)
    <option value="{{$movie->movieCat}}">{{$movie->movieCat}}</option>
    @endforeach
  </select>
</div>
</form>


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
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img height="600px" src="{{ $movie->movieImg }}" class="center" alt="...">
    </div>
    @foreach ($moviesSoon as $movie)
    <div class="carousel-item ">
      <img height="600px" src="{{ $movie->movieImg }}" class="center" alt="..." >
      {{ $movie->movieTitle }}
    </div>
    @endforeach
</div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="owl-carousel owl-theme mt-5">
        <div class="item"><h4>1</h4></div>
        <div class="item"><h4>2</h4></div>
        <div class="item"><h4>3</h4></div>
        <div class="item"><h4>4</h4></div>
        <div class="item"><h4>5</h4></div>
        <div class="item"><h4>6</h4></div>
        <div class="item"><h4>7</h4></div>
        <div class="item"><h4>8</h4></div>
        <div class="item"><h4>9</h4></div>
        <div class="item"><h4>10</h4></div>
        <div class="item"><h4>11</h4></div>
        <div class="item"><h4>12</h4></div>
</div>

@endsection

