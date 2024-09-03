<!-- resources/views/search/results.blade.php -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultados da Pesquisa</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Botão para abrir o menu offcanvas -->
                <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false" aria-label="{{ __('Toggle menu') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Botão para abrir o menu offcanvas em telas maiores -->
                <button class="navbar-toggler d-none d-md-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false" aria-label="{{ __('Toggle menu') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

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
                                <a class="nav-link" href="{{ route('profile.show', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('account.settings') }}">{{ __('Settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <h2>Resultados da Pesquisa</h2>
            <div class="row">
                <!-- Exibir usuários -->
                @if($users->count())
                    <div class="col-md-6">
                        <h3>Usuários</h3>
                        @foreach($users as $user)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="card-text">Email: {{ $user->email }}</p>
                                    <a href="{{ route('profile.show', $user->id) }}" class="btn btn-primary">Ver Perfil</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Exibir posts -->
                @if($posts->count())
                    <div class="col-md-6">
                        <h3>Posts</h3>
                        @foreach($posts as $post)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->body }}</p>
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Ler Mais</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
