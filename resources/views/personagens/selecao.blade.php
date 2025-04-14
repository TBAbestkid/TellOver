@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4" style="font-family: 'MedievalSharp', cursive; color: #6c5b7b;">Selecione um Personagem</h1>

    <!-- Botão Entrar no Mundo -->
    @if (session('personagem_selecionado'))
        <div class="text-center mb-4">
            <a href="{{ route('world.index') }}" class="btn btn-success btn-lg px-5 py-2" style="font-size: 1.2rem;">
                Entrar no Mundo
            </a>
        </div>
        <hr class="my-4">
    @endif

    @if ($personagens->isEmpty())
        <div class="alert alert-info text-center">
            Você ainda não tem personagens.
        </div>
    @else
        <div class="row gy-4">
            @foreach ($personagens as $personagem)
            <div class="col-md-4">
                <div class="card shadow-lg" style="border: 3px solid #6c5b7b; border-radius: 15px; background: #f8f1f1;">
                    <div class="row g-0">
                        <!-- Coluna para imagem ou ícone -->
                        <div class="col-auto d-flex align-items-center p-3">
                            @if ($personagem->imagem)
                                <img src="{{ asset($personagem->imagem) }}"
                                     class="rounded-circle"
                                     alt="Imagem do personagem"
                                     style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #6c5b7b;">
                            @else
                                <i class="fas fa-user fa-3x text-muted"></i>
                            @endif
                        </div>

                        <!-- Coluna para informações -->
                        <div class="col d-flex flex-column justify-content-center p-3">
                            <h5 class="mb-1" style="color: #355c7d;">{{ $personagem->nome }}</h5>
                            <p class="mb-2" style="font-size: 0.9rem; color: #6c5b7b;">Nível: {{ $personagem->nivel }}</p>

                            <!-- Formulário para selecionar o personagem -->
                            <form action="{{ route('personagem.select', $personagem->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" style="background: #355c7d; border: none;">
                                    Selecionar
                                </button>
                            </form>
                        </div>

                        <!-- Coluna para ícones de ações -->
                        <div class="col-auto d-flex align-items-center p-3">
                            <a href="{{ route('personagem.inventory', $personagem->id) }}" class="text-muted mx-2" title="Inventário">
                                <i class="fas fa-box fa-lg" style="color: #355c7d;"></i>
                            </a>
                            <a href="{{ route('personagem.edit', $personagem->id) }}" class="text-muted mx-2" title="Editar">
                                <i class="fas fa-edit fa-lg" style="color: #6c5b7b;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@include('partials.personagem_info')
@endsection
