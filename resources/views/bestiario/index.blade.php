@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif


    <h1>Bestiário</h1>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="monstros-tab" data-bs-toggle="tab" href="#monstros" role="tab" aria-controls="monstros" aria-selected="true">Monstros</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="npcs-tab" data-bs-toggle="tab" href="#npcs" role="tab" aria-controls="npcs" aria-selected="false">NPCs</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
        <!-- Monstros -->
        <div class="tab-pane fade show active" id="monstros" role="tabpanel" aria-labelledby="monstros-tab">
            <h2>Monstros</h2>
            <!-- Botão para adicionar novo monstro -->
            <a href="{{ route('bestiario.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus me-1"></i> Adicionar Monstro/NPC
            </a>

            @if($monstros->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i> Não há monstros cadastrados.
                </div>
            @else
                @foreach($monstros as $monstro)
                    <!-- Card do Monstro -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $monstro->nome }}</h5>
                                <div>
                                    <!-- Botão Visualizar -->
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewMonstroModal{{ $monstro->id }}" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Botão de Editar -->
                                    <a href="{{ route('bestiario.edit', $monstro->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div><strong>Nível:</strong> {{ $monstro->nivel }}</div>
                            <div><strong>Criador:</strong> {{ $monstro->narrador->name }}</div> <!-- Exibe o nome do narrador -->
                        </div>
                    </div>

                    <!-- Modal para visualizar os atributos do monstro -->
                    <div class="modal fade" id="viewMonstroModal{{ $monstro->id }}" tabindex="-1" aria-labelledby="viewMonstroLabel{{ $monstro->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewMonstroLabel{{ $monstro->id }}">Detalhes de {{ $monstro->nome }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Informações do Monstro -->
                                    <div><strong>Vida (HP):</strong> {{ $monstro->hp }}</div>
                                    <div><strong>Força:</strong> {{ $monstro->forca }}</div>
                                    <div><strong>Velocidade:</strong> {{ $monstro->velocidade }}</div>
                                    <div><strong>Precisão:</strong> {{ $monstro->precisao }}</div>
                                    <div><strong>Determinação:</strong> {{ $monstro->determinacao == 1 ? 'Sim' : 'Não' }}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            @endif
        </div>

        <!-- NPCs -->
        <div class="tab-pane fade" id="npcs" role="tabpanel" aria-labelledby="npcs-tab">
            <h2>NPCs</h2>

            @if($npcs->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i> Não há NPCs cadastrados.
                </div>
            @else
                @foreach($npcs as $npc)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $npc->nome }}</h5>
                                <div>
                                    <button class="btn btn-primary btn-sm" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div><strong>Nível:</strong> {{ $npc->nivel }}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
