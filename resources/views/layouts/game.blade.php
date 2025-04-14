<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Afterlife Engine</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/css/game.css', 'resources/js/app.js'])

</head>
<body>
    <div id="gameApp">
        <!-- Barra de Navegação do Jogo -->
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <!-- Ícone de Dragão usando FontAwesome -->
                    <i class="fas fa-dragon" style="font-size: 30px; margin-right: 10px;"></i>
                    Sotakedom
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item d-flex align-items-center">
                            <img src="https://cdn.discordapp.com/emojis/1043372349484974131.png?size=2048" alt="Moeda" style="width: 24px; height: 24px;" class="me-1">
                            <span>{{ number_format(Auth::user()->tabs ?? 0, 0, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Conteúdo Principal do Jogo -->
        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
