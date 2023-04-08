@extends('masterUser')

@section('content')

<div id="app">
  <table id="tableContent">

    @foreach ($movies as $movie)
    <tr class='trMovie'>
      <td data-toggle="modal" data-target="#a{{ $movie->movieId }}"><img class="imgContent" src="{{ $movie->movieImg }}"></td>
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
          <div class="modal-dialog modal-lg" >

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $movie->movieTitle }}</h4>
              </div>
              <div class="modal-body">
                <iframe class="iframe"  src="{{ $movie->movieTrailer }}" frameborder="0" allowfullscreen></iframe>
              </div>
              <div class="modal-footer">
                {{ $movie->movieGenre }} | {{ $movie->movieDuration }} мин. | Категория: {{ $movie->movieCat }} | {{ $movie->movieLan }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
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


<h2>Очаквайте</h2>
<div class="slider-container" item-display-d="4" item-display-t="3" item-display-m="1">
  <div class="slider-width">
    @foreach ($movieSoon as $movie)
    <div class="item"><img class="imgSoon" src="{{ $movie->movieImg }}" class="center" alt="..."></div>
    @endforeach
  </div>
  <button type="button" class="prev" onclick="prev()">Назад</button>
  <button type="button" class="next" onclick="next()">Напред</button>
</div>

<script src="{{ asset('js/menu.js') }}" defer></script>

@endsection