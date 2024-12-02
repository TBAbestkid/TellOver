<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    @vite('resources/css/app.css')

</head>
<body>
    <div id="app">
        <!-- Barra de Navegação -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            
                @auth
                    <!-- Botão para abrir o menu offcanvas -->
                    <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false" aria-label="{{ __('Toggle menu') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Botão para abrir o menu offcanvas em telas maiores -->
                    <button class="navbar-toggler d-none d-md-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false" aria-label="{{ __('Toggle menu') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                @endauth

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lado Esquerdo da Barra de Navegação -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Lado Direito da Barra de Navegação -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('personagem') }}">Personagens</a>
                            </li>
    
                            <!-- <li class="nav-item">
                                <form class="d-flex" action="{{ route('search') }}" method="GET">
                                    <input class="form-control me-2" type="search" name="query" placeholder="Pesquisar" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                                </form>
                            </li> -->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Menu Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show') }}">Perfil</a>
                        </li>
                        @if (Auth::user()->type == 2) <!-- Admin -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.gerenciar_narradores') }}">Gerenciar Narradores</a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Início</a>
                    </li>
                    @auth
                        <!-- Adicionar os links para novas páginas -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gerenciar.bestiario') }}">Bestiário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('misson.historico_missoes') }}">Histórico de Missões</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('misson.mission') }}">Missões</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calculadora.dano') }}">Calculadora de Dano</a>
                        </li>
                    @endauth
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('account.settings') }}">Configurações</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>



        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>