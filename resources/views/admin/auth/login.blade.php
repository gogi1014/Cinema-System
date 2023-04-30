<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('js/menu.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Admin Login</title>
</head>

<body class="vertical-layout vertical-menu-modern" id="backgroundAdmin" data-open="click" data-menu="vertical-menu-modern" data-col="" data-framework="laravel">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    Вход за администратор
                </div>
                <div class="auth-inner my-2">
                    <!-- Login basic -->
                    @if(\Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ \Session::get('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{ \Session::forget('success') }}
                    @if(\Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ \Session::get('error') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-body">

                        <form class="auth-login-form" action="{{route('adminLoginPost')}}" method="post">
                            @csrf
                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Имейл</label>
                                </div>
                                <input type="text" class="form-control" id="emailLogin" name="email" value="{{old('email') }}" autofocus />
                                @if ($errors->has('email'))
                                <span class="help-block font-red-mint">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Парола</label>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control" id="passwordLogin" name="password" tabindex="2" />
                                </div>
                                <div class="d-flex justify-content">
                                    <input type="checkbox" onclick="showPass()">Покажи парола
                                </div>
                                @if ($errors->has('password'))
                                <span class="help-block font-red-mint">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-outline-primary" tabindex="4">Влез</button>
                        </form>
                    </div>
                </div>

                <!-- /Login basic -->
            </div>
        </div>
    </div>
</body>

</html>