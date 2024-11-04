@extends('layouts.app')

@section('content')
<div class="container mt-5">
        <h1>Histórico de Missões</h1>

        <div class="card mb-3">
            <div class="card-header">
                Tipo de Missão: <span class="badge ">3 jogadores</span>
            </div>
            <div class="card-body">
                <p><strong>Jogadores:</strong> 
                <p>Jogador1</p>
                <p>Jogador2</p>
                <p>Jogador3</p>
                <p><strong>Descrição da Missão:</strong> Esta é a descrição da missão.</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Tipo de Missão: <span class="badge ">2 jogadores</span>
            </div>
            <div class="card-body">
                <p><strong>Jogadores:</strong> JogadorA, JogadorB</p>
                <p><strong>Descrição da Missão:</strong> Esta é outra descrição de missão.</p>
            </div>
        </div>

        <!-- Adicione mais missões conforme necessário -->
        <div class="text-center">
            <p class="text-muted">Nenhuma missão encontrada.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
