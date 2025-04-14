@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Histórico de Missões</h1>
    <hr>
    <div class="text-end mb-3">
        <!-- Botão para criar uma nova missão -->
        <a href="{{ route('misson.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i> Criar Missão
        </a>
    </div>
    @if($missoes->isEmpty())
        <!-- Alerta se não houver missões -->
        <div class="alert alert-info text-center py-3" role="alert" style="font-size: 1.25rem;">
            <i class="fas fa-info-circle fa-lg me-2"></i>
            Nenhuma missão encontrada. Crie uma missão para começar!
        </div>
    @else
        <!-- Loop pelas missões -->
        @foreach($missoes as $missao)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">{{ $missao->title }}</h4>
                    <small class="text-muted">Narrada por: {{ $missao->narrator->name ?? 'Desconhecido' }}</small>
                </div>
                <span class="badge
                    @if($missao->status == 'pending') bg-warning
                    @elseif($missao->status == 'in_progress') bg-primary
                    @else bg-success @endif">
                    {{ ucfirst(str_replace('_', ' ', $missao->status)) }}
                </span>
            </div>
            <div class="card-body">
                <p><strong>Nível:</strong> {{ $missao->level }}</p>
                <p><strong>Jogadores:</strong> {{ $missao->player_count }}</p>
                <p><strong>Descrição:</strong> {{ $missao->description }}</p>
            </div>
        </div>
        @endforeach
    @endif
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
