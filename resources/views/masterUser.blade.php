<!DOCTPE html>
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
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/vuesax@4.0.1-alpha.16/dist/vuesax.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css></script>
        <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js></script>
        <link href="https://fonts.cdnfonts.com/css/library-3-am" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/theatrical" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script type="text/javascript" src="{{ URL::asset('js/menu.js') }}"></script>
        <title>Система за кино</title>
    </head>
    <body>
        <div id="background">
            <div class="header">
                <div class="headerSearch">
                    <h1>Уеб информационна система за кино</h1>
                    <!-- search Laravel
                    <form id="searchMov" action="{{ url('/') }}" method="GET">
                        <input type="text" value="{{(request()->search)}}" name="search" class="searchTerm" required />
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search" class="searchButton"></i></button>
                    </form>
                    <form name="comboboxFilter" action="{{ url('/') }}" method="GET">
                        <div class="form-group">
                            <div class="selectCat">
                                <select name="category" onChange="comboboxFilter.submit();">
                                    <option disabled selected value> -- Изберете категория -- </option>
                                    <option value=" "> -- Всички -- </option>
                                    @foreach ($moviesAll as $movie)
                                    <option value="{{$movie->movieCat}}" @if(request()->category==$movie->movieCat) selected @endif>{{$movie->movieCat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                    <form name="genresCheckBox" action="{{ url('/') }}" method="GET" class="mb-3">
                        {{csrf_field()}}
                        <div class="form-group" id="checkGroup">
                            @foreach (($arr) as $moviesGenres)
                            <input type="checkbox" name="genres[{{$moviesGenres}}]" value="{{$moviesGenres}}" @if(request()->genres) @if(in_array($moviesGenres,request()->genres)) checked @endif @endif>{{$moviesGenres}}
                            @endforeach
                            <input type="submit" class="GenreButton" value="Търси по жанр" />
                        </div>
                    </form>
                     -->
                </div>
            </div>
            <div class="hero">
                <div class="image">
                    <div class="section">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="section">
                    </div>
                </div>
            </div>
            @yield('contentHeader')
            <div class="container" id="UserContainer">
                @yield('content')
            </div>
            <div class="footer">
                footer
            </div>
        </div>
    </body>

    </html>
    