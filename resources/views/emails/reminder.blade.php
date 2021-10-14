<!DOCTYPE html>
<html>

<head>
    <!-- CSS only -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400&display=swap');

        * {
            font-family: Lato;
            font-weight: 400;
        }

        .wrap {
            margin: 80px 0;
            justify-content: center;
            align-items: center;
            border: 1px solid gray;
            border-radius: 10px;
            padding: 40px;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .col {
            width: 100%;
            background-color: white;
            padding: 10px;
            margin-top: 20px;
        }

        .bold-text {
            font-weight: 600;
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="wrap">
    <div style="text-align: center">
        <img src="{{asset('images/logo.png')}}" alt="" style="width: 100%; max-width: 300px">
    </div>
    <div class="" style="width: 100%">
        <hr>
        <h3 style="text-align: center"><strong>{{$details['title']}}</strong></h3>
        <hr>
        <p>{!! $details['lesson_text']!!}</p>
        <hr>
        <div class="link">
            <a href="{{env('APP_URL')}}">Online Learning</a>
        </div>
    </div>
</div>


</body>

</html>
