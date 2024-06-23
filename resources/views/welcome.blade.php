@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{URL::asset("/css/welcome.css")}}">
@endsection
@section('wrapper')
    {{-- Info Main (Login & Register Area) --}}
    <div class="info main">
        <h2 class="title"><span class="highlight">Saunders</span> Robot Company</h2>
        <p class="subTitle">Empowering Industry with Innovation</p>
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
@endsection
