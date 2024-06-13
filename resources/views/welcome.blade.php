<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saunders Robot Company</title>
    <link rel="shortcut icon" href="{{URL::asset("/images/favicon/Saunders_Favicon.ico")}}" type="image/x-icon">
    <link rel="stylesheet" href="{{URL::asset("/css/welcome.css")}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    {{-- Navigation Bar --}}
    <nav class="nav welcome">
        <ul>
            <li>
                <a href="#" class="nav-logo"><img src="{{ URL::asset('/images/welcome_page/Saunders Logo.png') }}" alt="Saunders Co." height="40"></a>
            </li>
            <div class="nav-center">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Berita</a></li>
                <li><a href="#">Inspirasi</a></li>
                <li><a href="#">Finansial</a></li>
                <li><a href="#">Survei</a></li>
                <li><a href="#">WFH</a></li>
                <li><a href="#">Info IT</a></li>
            </div>
            <li>
                <a href="{{ route('login') }}" class="nav-login">Login</a>
            </li>
        </ul>
    </nav>

    {{-- Info Main (Login & Register Area) --}}
    <div class="info main">
        <h2 class="title"><span class="highlight">Saunders</span> Robot Company</h2>
        <p class="subTitle">Empowering Industry with Innovation</p>
        <div class="userButton">
            <a href="{{ route('login') }}" id="login">Login</a>
            <a href="{{ route('register') }}" id="register">Register</a>
        </div>
    </div>

    {{-- Company Short Profile Section --}}
    <div class="info profile">
        <div class="card purpose">
            <h2>Tujuan</h2>
            <img src="{{ URL::asset('/images/welcome_page/Leader.png') }}" alt="Leader" height="150">
            <p>
                Menjadi pemimpin global
                dalam industri robotika, dengan fokus pada pengembangan teknologi yang inovatif dan solusi
                otomatisasi yang meningkatkan efisiensi dan produktivitas industri di seluruh dunia.
            </p>
        </div>
        <div class="card vision">
            <h2>Visi</h2>
            <img src="{{ URL::asset('/images/welcome_page/Pioneer.png') }}" alt="Pioneer" height="150">
            <p>
                Menjadi pionir dalam revolusi industri berikutnya dengan menciptakan solusi
                robotika canggih yang tidak hanya memenuhi kebutuhan industri saat ini tetapi juga
                membentuk masa depan manufaktur dan otomatisasi industri.
            </p>
        </div>
        <div class="card mission">
            <h2>Misi</h2>
            <img src="{{ URL::asset('/images/welcome_page/Industrial Robot.png') }}" alt="Industrial Robot" height="150">
            <p>
                Mengembangkan teknologi robotika inovatif untuk meningkatkan efisiensi industri,
                memastikan keandalan produk, mendukung transformasi digital,
                menyediakan layanan pelanggan yang komprehensif, dan mempromosikan praktik berkelanjutan.
            </p>
        </div>
    </div>
</body>
</html>
