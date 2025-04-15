<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="images/logos-site-T.png" type="image/x-icon">

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
                            <li class="nav-item d-flex align-items-center ms-3 ">
                                <!-- Exibir moedas com badge -->
                                <img src="https://cdn.discordapp.com/emojis/1043372349484974131.png?size=2048" alt="Moeda" style="width: 24px; height: 24px;" class="me-1">
                                <span class="">
                                    {{ number_format(Auth::user()->tabs ?? 0, 0, ',', '.') }}
                                </span>
                            </li>
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
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('bestiario.index') }}">Bestiário</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('misson.index') }}">Gerenciador de Missões</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calculadora.dano') }}">Calculadora de Dano</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calculadora.regras') }}">Regras RPG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personagem.selecao') }}">Entrar em Gukin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('world.titlescreen') }}">Tela Inicial</a>
                        </li> --}}
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

        <!-- Modal de Confirmação de Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirmar Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que deseja sair?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
