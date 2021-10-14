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
    </style>
</head>

<body>
<div class="wrap">
    <div style="text-align: center">
        {{--        <img src="https://barviewguru.com/images/logo.png" alt="">--}}
    </div>
    <div class="" style="width: 100%">
        <p class="bold-text"><b>Name:</b> {{ $details['name'] }}</strong></p>
        <hr>
        <p>Message:</p>
        <hr>
        <div class="link">
            <a href="">Online Learning</a>
        </div>
    </div>
</div>


</body>

</html>
