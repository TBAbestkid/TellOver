@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="row">
        <div class="col-md-4">
            <h4>Lista de Personagens</h4>
            @if($personagens->isEmpty()) <!-- Verifica se não há personagens -->
                <div class="alert alert-warning" role="alert">
                    Você ainda não tem personagens! <a href="{{ route('criarpersonagem') }}" class="alert-link">Crie um agora!</a>
                </div>
            @else
                <ul class="list-group">
                    @foreach($personagens as $personagem)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $personagem->nome }}
                            <span class="badge text-bg-secondary badge-pill">Nível {{ $personagem->nivel }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Detalhes do Personagem</h4>
                    <a href="{{ route('criarpersonagem') }}" class="btn btn-primary text-end">Criar personagem?</a>
                </div>
                <div class="card-body">
                    @if($personagens->isNotEmpty())
                        @foreach($personagens as $personagem) <!-- Loop para exibir todos os personagens -->
                            @php
                                $habilidades = json_decode($personagem->habilidades, true);
                                $habilidades_ativas = [];
                                foreach ($habilidades as $habilidade => $valor) {
                                    if ($valor == 1) {
                                        $habilidades_ativas[] = ucfirst($habilidade); // Adiciona as habilidades ativadas
                                    }
                                }
                            @endphp

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="d-flex justify-content-between align-items-center">
                                        <!-- Nome do Personagem -->
                                        <span>{{ $personagem->nome }}</span>

                                        <!-- Botões de Visualizar, Editar, Deletar e Inventário -->
                                        <div class="btn-group" role="group">
                                            <!-- Botão de Visualizar com Ícone de Olho -->
                                            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHP{{ $personagem->id }}" aria-expanded="false" aria-controls="collapseHP{{ $personagem->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Botão de Editar -->
                                            <a href="{{ route('personagem.edit', $personagem->id) }}" class="btn btn-outline-dark btn-sm mx-1"><i class="fas fa-edit"></i></a>

                                            <!-- Botão de Deletar -->
                                            <form action="{{ route('personagem.destroy', $personagem->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-dark btn-sm mx-1"><i class="fas fa-trash"></i></button>
                                            </form>

                                            <!-- Botão de Visualizar Inventário -->
                                            <a href="{{ route('personagem.inventory', $personagem->id) }}" class="btn btn-outline-dark btn-sm mx-1">
                                                <i class="fas fa-box"></i>
                                            </a>
                                        </div>
                                    </h5>
                                </div>
                                <div class="">
                                    <!-- Accordion para exibir os detalhes -->
                                    <div class="accordion" id="personagensAccordion">
                                        <div class="accordion-item">
                                            <div id="collapseHP{{ $personagem->id }}" class="accordion-collapse collapse" aria-labelledby="headingHP{{ $personagem->id }}" data-bs-parent="#personagensAccordion">
                                                <div class="accordion-body">
                                                    <p><strong>Nome:</strong> {{ $personagem->nome }}</p>
                                                    <p><strong>Nível:</strong> {{ $personagem->nivel }}</p>
                                                    <p><strong>Habilidades:</strong>
                                                        @php
                                                            $habilidades = json_decode($personagem->habilidades, true);
                                                            $habilidades_ativas = [];
                                                            foreach ($habilidades as $habilidade => $valor) {
                                                                if ($valor == 1) {
                                                                    $habilidades_ativas[] = ucfirst($habilidade); // Adiciona habilidades ativadas
                                                                }
                                                            }
                                                        @endphp
                                                        @if(count($habilidades_ativas) > 0)
                                                            {{ implode(', ', $habilidades_ativas) }} <!-- Exibe as habilidades ativadas -->
                                                        @else
                                                            Nenhuma <!-- Se nenhuma habilidade for ativada -->
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning" role="alert">
                            Você ainda não tem personagens! <a href="{{ route('criarpersonagem') }}" class="alert-link">Crie um agora!</a>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
