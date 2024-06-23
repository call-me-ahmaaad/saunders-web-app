<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saunders Robot Company</title>
    <link rel="shortcut icon" href="{{URL::asset("/images/favicon/Saunders_Favicon.ico")}}" type="image/x-icon">
    <link rel="stylesheet" href="{{URL::asset("/css/mainLayout.css")}}">
    @yield('css')
    @yield('javascript')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="nav welcome">
        @include('partials.navbar')
    </nav>
    <div class="wrapper">
        @yield('wrapper')
    </div>
</body>
</html>
