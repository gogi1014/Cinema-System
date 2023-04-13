@extends('master')

@section('content')

<div class="container">
    <h1>Администраторски панел</h1>
    <div class="container">
        <div class="row justify-content-center" id="welcome">
            <div class="col-4">
            <i class="bi-gear"></i>
            <i class="fa fa-film" aria-hidden="true"></i>
                {{$movieCount}}
            </div>
            <div class="col-4">
            <i class="fa fa-user" aria-hidden="true"></i>

                {{$userCount}}
            </div>
        </div>
    </div>
</div>
</div>

@endsection