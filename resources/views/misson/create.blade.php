@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4 text-center">Criar Missão</h1>

    <form action="{{ route('misson.store') }}" method="POST"
        class="mx-auto" style="max-width: 600px; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <div class="form-floating">
                    <select class="form-select" id="tipoMissao" name="tipo" required>
                        <option value="" disabled selected>Selecione o Tipo de Missão</option>
                        <option value="missao">Missão</option>
                        <option value="evento">Evento</option>
                        <option value="guerra">Guerra</option>
                        <option value="dungeon">Dungeon</option>
                    </select>
                    <label for="tipoMissao">Tipo de Missão</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <select class="form-select" id="guildaMissao" name="guilds_id" required>
                        <option value="" disabled selected>Selecione a Guilda</option>
                        @foreach($guilds as $guild)
                            <option value="{{ $guild->id }}">{{ $guild->name }}</option>
                        @endforeach
                    </select>
                    <label for="guildaMissao">Guilda</label>
                </div>
            </div>
            <div class="col">
                <div class="d-flex align-items-center">
                    <label for="nivelMissao" class="me-2">Nível:</label>
                    <div class="input-group" style="width: 100px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decrementar()">-</button>
                        <input type="number" class="form-control text-center" id="nivelMissao" name="nivel" value="0" min="0" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="incrementar()">+</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="quantidadePlayers" name="quantidade_jogadores" placeholder="Número de Jogadores" required>
            <label for="quantidadePlayers">Quantidade de Jogadores</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" id="descricaoMissao" name="descricao" rows="4" placeholder="Descreva a missão..." required></textarea>
            <label for="descricaoMissao">Descrição</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-3">Criar Missão</button>
    </form>

</div>

<!-- Links para o Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    function incrementar() {
        let nivelInput = document.getElementById('nivelMissao');
        // Verifica se o valor atual é um número e incrementa
        if (!isNaN(nivelInput.value)) {
            nivelInput.value = parseInt(nivelInput.value) + 1;
        }
    }

    function decrementar() {
        let nivelInput = document.getElementById('nivelMissao');
        // Verifica se o valor atual é um número e é maior que 0 antes de decrementar
        if (!isNaN(nivelInput.value) && parseInt(nivelInput.value) > 0) {
            nivelInput.value = parseInt(nivelInput.value) - 1;
        }
    }
</script>
@endsection
