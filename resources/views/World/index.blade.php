@extends('layouts.app')

@section('content')
<style>
    /* Estilo para os botões de reino */
    .kingdom-btn {
        position: relative;
        width: 100%;
        height: 250px; /* Tamanho fixo para os botões */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        overflow: hidden;
        transition: opacity 0.3s;
    }

    /* Ajuste as imagens para não distorcerem */
    .kingdom-img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
        transition: opacity 0.3s;
    }

    /* Efeito de iluminação quando o mouse passa sobre o botão */
    .kingdom-btn:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: rgba(0, 123, 255, 0.1);
    }

    /* Efeito de iluminação nas imagens */
    .kingdom-btn:hover .kingdom-img {
        opacity: 0.7;
    }

    /* Quando o mouse sai do botão, restaurar os botões e imagens */
    .kingdom-btn:hover {
        opacity: 1;
    }

    /* Estilo para os botões de destaque */
    .kingdom-btn[data-kingdom="gzat"]:hover {
        background-color: rgba(0, 123, 255, 0.2);
    }

    .kingdom-btn[data-kingdom="holdald"]:hover {
        background-color: rgba(0, 123, 255, 0.2);
    }

    .kingdom-btn[data-kingdom="whidifrohente"]:hover {
        background-color: rgba(0, 123, 255, 0.2);
    }

    .kingdom-btn[data-kingdom="yagozashi"]:hover {
        background-color: rgba(0, 123, 255, 0.2);
    }
</style>
<div class="container mt-5">
    <h1 class="text-center">Selecione um Reino</h1>

    <div class="row justify-content-center mt-4">
        <!-- Reino Gzat -->
        <div class="col-md-4 mb-4"> <!-- Aumentei para col-md-4 -->
            <a href="{{ route('world.region', ['id' => 1]) }}" class="btn btn-outline-primary w-100 kingdom-btn" data-kingdom="gzat">
                <img src="https://media.discordapp.net/attachments/725177956816781363/1314670015030755429/gzat.png?ex=67549d5c&is=67534bdc&hm=b265e96529a646bcf0a0adbe9bd4129bf7b4459ae054a64ec5398ae039b2fa0c&=&format=webp&quality=lossless&width=532&height=559" alt="Gzat" class="kingdom-img" />
                <span class="d-block mt-2">Gzat</span>
            </a>
        </div>

        <!-- Reino Holdald -->
        <div class="col-md-4 mb-4"> <!-- Aumentei para col-md-4 -->
            <a href="{{ route('world.region', ['id' => 2]) }}" class="btn btn-outline-primary w-100 kingdom-btn" data-kingdom="holdald">
                <img src="https://media.discordapp.net/attachments/725177956816781363/1314670014493626368/holdald.png?ex=67549d5c&is=67534bdc&hm=3f9eace4cf1c63173165cdd171a1a70f293d7022edddece9f6c73c0616d01a8a&=&format=webp&quality=lossless&width=421&height=559" alt="Holdald" class="kingdom-img" />
                <span class="d-block mt-2">Holdald</span>
            </a>
        </div>

        <!-- Reino Whidifrohente -->
        <div class="col-md-4 mb-4"> <!-- Aumentei para col-md-4 -->
            <a href="{{ route('world.region', ['id' => 3]) }}" class="btn btn-outline-primary w-100 kingdom-btn" data-kingdom="whidifrohente">
                <img src="https://media.discordapp.net/attachments/725177956816781363/1314670013650698422/Whidifrohente.jpg?ex=67549d5c&is=67534bdc&hm=fcb0c59826581a4464ef53c135c73f7169f431ef5bea828c47bec40576a3b07e&=&format=webp&width=358&height=559" alt="Whidifrohente" class="kingdom-img" />
                <span class="d-block mt-2">Whidifrohente</span>
            </a>
        </div>

        <!-- Reino Yagozashi -->
        <div class="col-md-4 mb-4"> <!-- Aumentei para col-md-4 -->
            <a href="{{ route('world.region', ['id' => 4]) }}" class="btn btn-outline-primary w-100 kingdom-btn" data-kingdom="yagozashi">
                <img src="https://media.discordapp.net/attachments/725177956816781363/1314670013130473593/Yagozashi.png?ex=67549d5c&is=67534bdc&hm=91d69f334fffe378a1aabe31c2d8f2e3168160d531fccc460d12f9f671264f36&=&format=webp&quality=lossless&width=315&height=559" alt="Yagozashi" class="kingdom-img" />
                <span class="d-block mt-2">Yagozashi</span>
            </a>
        </div>
    </div>
</div>
@include('partials.personagem')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Seleciona todos os botões dos reinos
    const kingdomButtons = document.querySelectorAll('.kingdom-btn');

    // Para cada botão, ao passar o mouse, ilumina o botão e escurece os outros
    kingdomButtons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            kingdomButtons.forEach(btn => {
                if (btn !== button) {
                    btn.style.opacity = 0.5;
                }
            });
        });

        button.addEventListener('mouseleave', () => {
            kingdomButtons.forEach(btn => {
                btn.style.opacity = 1;
            });
        });
    });
});
</script>

@endsection
