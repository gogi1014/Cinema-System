<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Test Email</title>
</head>
<body>
<div id="background">
<h1>Здравейте, {{ $full }}!</h1>
<p><strong>Направихте резервация за филма: {{$movieName}}</strong></p>
<p><strong>на дата: {{$date}}</strong></p>
<p><strong>от: {{$time}} часа</strong></p>
<p><strong>брой билети: {{$ticknum}}</strong></p>
<p><strong>места: {{$places}}</strong></p>
<p><strong>№ на резервация: #{{$ticked_id}}</strong></p>
</div>
</body>
</html>