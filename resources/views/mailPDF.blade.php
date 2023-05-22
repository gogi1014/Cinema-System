<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Email</title>
    <style type="text/css">
        body {
            background-color: #FCD000;
        }
        * {
            font-family: "DejaVu Sans", sans-serif;
        }
        .ticket__content {
            box-sizing: border-box;
            height: 100%;
            width: 100%;
            border: 6px solid #D8D8D8;
        }
        .ticket {
            position: relative;
            box-sizing: border-box;
            width:  50%;
            height: 500px;
            margin: 150px auto 0;
            padding: 20px;
            border-radius: 10px;
            background: #FBFBFB;
            box-shadow: 2px 2px 15px 0px #AB9B0D;

        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="ticket__content">
            <h3><strong>Резервация</strong></h3>
            <p><strong>Име на резервиращ: {{ $full }}</strong></p>
            <p><strong>Име на филм: {{$movieName}}</strong></p>
            <p><strong>дата: {{$date}}</strong></p>
            <p><strong>от: {{$time}} часа</strong></p>
            <p><strong>брой билети: {{$ticknum}}</strong></p>
            <p><strong>места: {{$places}}</strong></p>
            <p><strong>№ на резервация: #{{$ticked_id}}</strong></p>
        </div>
    </div>

</body>

</html>