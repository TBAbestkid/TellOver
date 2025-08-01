<div class="card mb-3">
    <div class="card-body">
        @auth
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="#">🏠 Início</a></li>
                <li class="nav-item"><a class="nav-link" href="#">👤 Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="#">🔍 Explorar</a></li>
                <li class="nav-item"><a class="nav-link" href="#">⚙️ Configurações</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#postModal">
                        <i class="bi bi-pencil-square me-1"></i> Novo Post
                    </a>
                </li>
            </ul>
        @endauth

        @guest
            <div class="">
                <h5 class="mb-3 text-center">👋 Visitando?</h5>
                <p>Seja bem-vindo ao <strong>TellOver</strong>!</p>
                <p>Faça login ou crie uma conta para começar a compartilhar suas histórias.</p>
                <p class="mb-2">Você pode:</p>
                <ul class="list-unstyled">
                    <li>📖 Ler posts de outros usuários</li>
                    <li>💬 Comentar e interagir com as histórias</li>
                    <li>❤️ Curtir os posts que você gosta</li>
                    <li>🔗 Compartilhar suas próprias histórias</li>
                </ul>
                <p class="mb-2 text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-1">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Cadastrar</a>
                </p>
            </div>
        @endguest
    </div>
</div>
