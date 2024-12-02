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
                    @if($personagens->isNotEmpty()) <!-- Exibe os detalhes do primeiro personagem, se houver -->
                        <h2 class="accordion-header" id="headingHP">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHP" aria-expanded="true" aria-controls="collapseHP">
                                {{ $personagens[0]->nome }}
                            </button>
                        </h2>
                        <div id="collapseHP" class="accordion-collapse collapse show" aria-labelledby="headingHP" data-bs-parent="#rulesAccordion">
                            <div class="accordion-body">
                                <hr>
                                <p><strong>Nome:</strong> {{ $personagens[0]->nome }}</p>
                                <p><strong>Nível:</strong> {{ $personagens[0]->nivel }}</p>
                                <p><strong>Habilidades:</strong> 
                                    @php
                                        $habilidades = json_decode($personagens[0]->habilidades, true); 
                                        $habilidades = is_array($habilidades) ? $habilidades : [];
                                    @endphp
                                    {{ implode(', ', $habilidades) ?: 'Nenhuma' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <p>Selecione um personagem para ver os detalhes.</p>
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
