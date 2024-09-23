@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Histórico de Missões</h1>

        @if($missoes->isEmpty())
            <p>Nenhuma missão encontrada.</p>
        @else
            @foreach($missoes as $missao)
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>{{ $missao->tipo_missao }}</strong> 
                        <span class="badge badge-secondary">{{ $missao->quantidade_players }} jogadores</span>
                    </div>
                    <div class="card-body">
                        <p><strong>Jogadores:</strong> {{ $missao->nome_players }}</p>
                        <p>{{ $missao->descricao_missao }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

