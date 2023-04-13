<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/laravel-vue-pagination@2.3.1/dist/laravel-vue-pagination.umd.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vuesax@4.0.1-alpha.16/dist/vuesax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css></script>
    <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" />
    <script defer src="plugins/OwlCarousel2.3/owl.carousel.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script type="text/javascript" src="{{ URL::asset('js/menu.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>


    <title>View Student Records</title>
</head>

<body id="background">
    <div class="container" id="UserContainer">       
        <nav class="navbar navbar-light bg-light">
        <h1 class="navbar-brand">Отворена база данни за филми</h1>
        <a class="nav-item" href="/api/movie">
            <button class="btn btn-secondary">Покажи всички филми</button>
        </a>
        <button class="nav-item btn btn-secondary" data-toggle="modal" data-target="#a"> Създай</button>
        <div class="form-inline">
            Търсене на филм по ID: <input type="text" id="filterID" />
            <input type="submit" value="Търси" onclick="formdata()" /><br>
        </div>
        </nav>

        <div class="modal fade" id="a" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Създай</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/api/movie') }}" method="post">
                            <!-- Modal content-->
                            @csrf
                            <div class="form-group">
                                <label for="movieImg">Постер</label>
                                <input type="text" class="form-control" name="movieImg" id="movieImg" placeholder="Постер">
                            </div>
                            <div class="form-group">
                                <label for="movieTitle">Заглавие</label>
                                <input type="text" class="form-control" name="movieTitle" id="movieTitle" placeholder="Заглавие">
                            </div>
                            <div class="form-group">
                                <label for="movieTrailer">Трейлър</label>
                                <input type="text" class="form-control" name="movieTrailer" id="movieTrailer" placeholder="Заглавие">
                            </div>
                            <div class="form-group">
                                <label for="movieGenre">Жанр</label>
                                <input type="text" class="form-control" name="movieGenre" id="movieGenre" placeholder="Жанр">
                            </div>
                            <div class="form-group">
                                <label for="movieDuration">Времетраене</label>
                                <input type="number" class="form-control" name="movieDuration" id="movieDuration" placeholder="Времетраене">
                            </div>
                            <div class="form-group">
                                <label for="movieRelDate">Дата на излизане</label>
                                <input type="date" class="form-control" name="movieRelDate" id="movieRelDate" placeholder="Дата на излизане">
                            </div>
                            <div class="form-group">
                                <label for="movieDirector">Режисьор</label>
                                <input type="text" class="form-control" name="movieDirector" id="movieDirector" placeholder="Режисьор">
                            </div>
                            <div class="form-group">
                                <label for="movieActors">Актъори</label>
                                <input type="text" class="form-control" name="movieActors" id="movieActors" placeholder="Актъори">
                            </div>
                            <div class="form-group">
                                <label for="Description">Описание</label>
                                <textarea rows="5" cols="60" type="text" class="form-control" name="Description" id="Description" placeholder="Описание"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="movieLan">Език</label>
                                <input type="text" class="form-control" name="movieLan" id="movieLan" placeholder="Език">
                            </div>
                            <div class="form-group">
                                <label for="movieCat">Категория</label>
                                <input type="text" class="form-control" name="movieCat" id="movieCat" placeholder="Категория">
                            </div>
                            <div class="form-group">
                                <label for="active">Активен</label>
                                <input type="number" class="form-control" name="active" id="active" placeholder="Активен">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h1>Всички филми</h1>
        @foreach ($movies as $movie)
        <div>
            Id:{{ $movie->movieId }} | Заглавие:{{ $movie->movieTitle }}
            <form id="searchform" action="{{route('movie.destroy', $movie->movieId)}}" method="POST">
                @csrf
                @method('DELETE')

                <button id="deleteBtn" class="btn btn-secondary btn-sm" type="submit">Изтрий</button>
            </form>
            <button id="editBtn" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#a{{ $movie->movieId }}"> Редактирай</button>
            <div class="modal fade" id="a{{ $movie->movieId }}" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Редактиране</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('movie.update', $movie->movieId)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                <label for="movieImg">Постер</label>
                                <input type="text" value="{{ $movie->movieImg }}"  class="form-control" name="movieImg" id="movieImg" placeholder="Постер">
                            </div>
                            <div class="form-group">
                                <label for="movieTitle">Заглавие</label>
                                <input type="text" value="{{ $movie->movieTitle }}" class="form-control" name="movieTitle" id="movieTitle" placeholder="Заглавие">
                            </div>
                            <div class="form-group">
                                <label for="movieTrailer">Трейлър</label>
                                <input type="text" value="{{ $movie->movieTrailer }}" class="form-control" name="movieTrailer" id="movieTrailer" placeholder="Заглавие">
                            </div>
                            <div class="form-group">
                                <label for="movieGenre">Жанр</label>
                                <input type="text" value="{{ $movie->movieGenre }}" class="form-control" name="movieGenre" id="movieGenre" placeholder="Жанр">
                            </div>
                            <div class="form-group">
                                <label for="movieDuration">Времетраене</label>
                                <input type="number" value="{{ $movie->movieDuration }}" class="form-control" name="movieDuration" id="movieDuration" placeholder="Времетраене">
                            </div>
                            <div class="form-group">
                                <label for="movieRelDate">Дата на излизане</label>
                                <input type="date" value="{{ $movie->movieRelDate }}" class="form-control" name="movieRelDate" id="movieRelDate" placeholder="Дата на излизане">
                            </div>
                            <div class="form-group">
                                <label for="movieDirector">Режисьор</label>
                                <input type="text" value="{{ $movie->movieDirector }}" class="form-control" name="movieDirector" id="movieDirector" placeholder="Режисьор">
                            </div>
                            <div class="form-group">
                                <label for="movieActors">Актъори</label>
                                <input type="text" value="{{ $movie->movieActors }}" class="form-control" name="movieActors" id="movieActors" placeholder="Актъори">
                            </div>
                            <div class="form-group">
                                <label for="Description">Описание</label>
                                <input  type="text" value="{{ $movie->Description }}" class="form-control" name="Description" id="Description" >
                            </div>
                            <div class="form-group">
                                <label for="movieLan">Език</label>
                                <input type="text" value="{{ $movie->movieLan }}" class="form-control" name="movieLan" id="movieLan" placeholder="Език">
                            </div>
                            <div class="form-group">
                                <label for="movieCat">Категория</label>
                                <input type="text" value="{{ $movie->movieCat }}" class="form-control" name="movieCat" id="movieCat" placeholder="Категория">
                            </div>
                            <div class="form-group">
                                <label for="active">Активен</label>
                                <input type="number" value="{{ $movie->active }}" class="form-control" name="active" id="active" placeholder="Активен">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach




</body>

</html>