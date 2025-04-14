@extends('layouts.game')

@section('content')
<style>
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Fundo preto semi-transparente */
        z-index: -1; /* Faz o overlay ficar atrás do conteúdo */
        background-image: url('https://images6.alphacoders.com/113/1133701.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    /* Estilo para a transição de fade */
    .fade {
        transition: opacity 0.5s ease-in-out;
        opacity: 1;
    }

    .fade.out {
        opacity: 0;
    }

    /* Estilo para a transição de slide */
    .page {
        transition: transform 0.5s ease-in-out;
    }

    .page.out {
        transform: translateX(100%);
    }

</style>
<div id="spinner" class="d-none text-center">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Carregando...</span>
    </div>
</div>
<div class=" ">
    <!-- Sidebar (Fixado ao lado) -->
    <div class="col-md-2 sidebar p-4 d-flex flex-column justify-content-between" style="position: fixed; top: 56px; left: 0; height: 100%; overflow-y: auto;">
        <div>
            <button class="btn w-100 mb-3" onclick="changeContent('Iniciar', 'Selecione um personagem para começar a jogar.')">Iniciar</button>
            <button class="btn w-100 mb-3" onclick="changeContent('Créditos', 'Desenvolvedor: TBAbestkid<br>Design: Nome do Designer')">Créditos</button>
            <button class="btn w-100 mb-3" onclick="changeContent('Configurações', 'Ajuste o som, gráficos e outras opções.')">Configurações</button>
            <button class="btn w-100 mb-3" onclick="changeContent('Ajuda', 'Para dúvidas ou ajuda, entre em contato conosco!')">Ajuda</button>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="col-md-10 offset-md-2 main-content p-4 text-dark">
        <!-- Conteúdo Dinâmico -->
        <div id="dynamicContent" class="text-center">
            <h2 id="contentTitle">Bem-vindo ao The Afterlife Engine</h2>
            <p id="contentText">Um sussurro do além que ecoa através das eternidades...</p>
        </div>

        <!-- Tela Inicial com seleção de personagem -->
        <div id="telaInicial" class="mb-4" style="display: none;">
            <h3 class="text-center mb-4">Selecione um Personagem</h3>
            <div style="display: none;" id="btnEntrarNoMundo">
                <div class="text-center mb-4">
                    <a href="{{ route('world.systemsun') }}" class="btn btn-success btn-lg">Entrar no Mundo</a>
                </div>
                <hr class="my-4">
            </div>

            @if ($personagens->isEmpty())
                <div class="alert alert-info text-center">
                    Você ainda não tem personagens.
                </div>
            @else
                <div class="row gy-4">
                    @foreach ($personagens as $personagem)
                        <div class="col-md-4">
                            <div class="card shadow-lg" style="border-radius: 15px; background-color: rgba(0, 0, 0, 0.6);">
                                <div class="row g-0">
                                    <div class="col-auto p-3">
                                        @if ($personagem->imagem)
                                            <img src="{{ asset($personagem->imagem) }}" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                        @else
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        @endif
                                    </div>

                                    <div class="col p-3">
                                        <h5 class="mb-1">{{ $personagem->nome }}</h5>
                                        <p class="mb-2" style="font-size: 0.9rem;">Nível: {{ $personagem->nivel }}</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100 select-personagem-btn" data-id="{{ $personagem->id }}">
                                            Selecionar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Créditos -->
        <div id="creditosContent" style="display: none;">
            <h4>Créditos</h4>
            <p>Desenvolvedor: TBAbestkid, uma desenvolvedora sonhadora que almeja criar jogos de qualidade e histórias envolventes. Obrigado por jogar e apoiar!</p>
        </div>

        <!-- Ajuda -->
        <div id="ajudaContent" style="display: none;">
            <h4>Ajuda</h4>
            <p>Para dúvidas ou ajuda, entre em contato conosco:</p>
            <ul>
                <li>Email: <a href="mailto:telldarbro@gmail.com">telldarbro@gmail.com</a></li>
                <li>Twitter: <a href="https://x.com/TBestkid" target="_blank">TBestkid</a></li>
                <li>Instagram: <a href="https://www.instagram.com/tbabestkid_/" target="_blank">tbabestkid_</a></li>
            </ul>
        </div>
    </div>
    <div class="toast alert alert-${type} fade-in" aria-live="polite" role="alert"></div>
</div>
<script>
   function changeContent(title, text) {
        const sections = ['ajudaContent', 'creditosContent', 'telaInicial'];
        sections.forEach(section => document.getElementById(section).style.display = 'none');

        const currentSection = title === 'Ajuda' ? 'ajudaContent' :
                            title === 'Créditos' ? 'creditosContent' :
                            title === 'Iniciar' ? 'telaInicial' : null;

        if (currentSection) {
            document.getElementById(currentSection).style.display = 'block';
        }

        document.getElementById('contentTitle').innerHTML = title;
        document.getElementById('contentText').innerHTML = text;
    }
    // Inicializa com a tela de boas-vindas
    changeContent('The Afterlife Engine', 'Um sussurro do além que ecoa através das eternidades...');
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM completamente carregado e processado.');
        const selectButtons = document.querySelectorAll('.select-personagem-btn');
        const spinner = document.getElementById('spinner');

        selectButtons.forEach(button => {
            button.addEventListener('click', function () {
                const personagemId = this.dataset.id; // Obtém o ID do personagem
                console.log(`/personagem/selecionar/${personagemId}`);

                // Exibe o spinner
                spinner.classList.remove('d-none');

                fetch(`/personagem/selecionar/${personagemId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // Token CSRF
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    // Oculta o spinner após a resposta
                    spinner.classList.add('d-none');

                    if (!response.ok) {
                        throw new Error('Erro na requisição');
                    }
                    return response.json();
                })
                .then(data => {
                    // Sucesso na requisição
                    console.log(data.message);

                    // Mostra um toast com a mensagem de sucesso
                    showToast('success', data.message);

                    // Exibe o botão "Entrar no Mundo"
                    const btnEntrarNoMundo = document.getElementById('btnEntrarNoMundo');
                    if (btnEntrarNoMundo) {
                        btnEntrarNoMundo.style.display = 'block';
                    }
                    spinner.classList.add('d-none');
                })
                .catch(error => {
                    // Oculta o spinner em caso de erro
                    spinner.classList.add('d-none');

                    console.error('Erro na requisição:', error);
                    showToast('danger', 'Erro ao selecionar personagem');
                });
            });
        });
    });

    function showToast(type, message) {
        console.log('Toast sendo criado:', type, message);

        // Verifica se já existe um toast na página
        if (document.querySelector('.toast')) {
            return; // Evita adicionar mais de um toast
        }

        const toast = document.createElement('div');
        toast.className = `toast alert alert-${type} fade-in`;
        toast.textContent = message;
        document.body.appendChild(toast);
        console.log('Toast adicionado ao DOM.');

        setTimeout(() => {
            toast.classList.add('fade-out');
            toast.addEventListener('transitionend', () => {
                toast.remove();
                console.log('Toast removido após 3 segundos.');
            });
        }, 3000);
    }
</script>
<script>
    document.getElementById('entrarNoMundoBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Evita o redirecionamento imediato

        // Adiciona a classe "out" para animar a página saindo
        document.getElementById('pageContent').classList.add('out');
        document.getElementById('dynamicContent').classList.add('fade', 'out');

        // Espera a animação terminar antes de redirecionar
        setTimeout(function() {
            window.location.href = "{{ route('world.systemsun') }}"; // Redireciona para a nova página
        }, 500); // O tempo de 500ms é o tempo da animação
    });
</script>
@endsection
