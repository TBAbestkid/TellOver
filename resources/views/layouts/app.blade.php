<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/logos-site-T.png') }}" type="image/x-icon">

    <title>@yield('title', 'TellOver')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/post-utils.js', 'resources/js/add-posts.js'])

    @stack('custom-assets')

</head>
<body>
    <div id="app">
        <!-- Barra de Navegação -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
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
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastro') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">Sobre o Tellover</a>
                            </li>
                        @else
                            @include('partials.notifications')
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Menu Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
            </div>
            <div class="offcanvas-body px-3">
                @auth
                   <!-- Usuário logado -->
                    <div class="d-flex align-items-center mb-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle" width="40">
                        @else
                            <i class="fas fa-user-circle fa-2x text-secondary"></i>
                        @endif

                        <div class="ms-3">
                            <strong>{{ Auth::user()->name }}</strong><br>
                            <small class="text-muted">
                                {{ Auth::user()->username ?: strtolower(str_replace(' ', '', Auth::user()->name)) }}
                            </small>
                        </div>
                    </div>
                @endauth

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="fas fa-home me-2"></i> Início
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show', [
                                'identificador' => Auth::user()->username
                                    ?? strtolower(str_replace(' ', '', Auth::user()->name))
                            ]) }}">
                                <i class="fas fa-user-circle me-2"></i> Perfil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('account.settings') }}">
                                <i class="fas fa-cog me-2"></i> Configurações
                            </a>
                        </li>

                        @if (Auth::user()->role === 2) {{-- Admin --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.gerenciar_narradores') }}">
                                    <i class="fas fa-users-cog me-2"></i> Administração
                                </a>
                            </li>
                        @endif

                        <hr class="my-2">

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Sair
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-2"></i> Entrar
                                </a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-2"></i> Registrar
                                </a>
                            </li>
                        @endif
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

    <!-- Bootstrap JS (essencial para o menu funcionar) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
