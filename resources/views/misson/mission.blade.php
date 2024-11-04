@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Criar Missão</h1>

        <form class="mx-auto" style="max-width: 600px; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <div class="row mb-3">
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="tipoMissao" required>
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
                    <div class="d-flex align-items-center">
                        <label for="nivelMissao" class="me-2">Nível:</label>
                        <div class="input-group" style="width: 100px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="decrementar()">-</button>
                            <input type="number" class="form-control text-center" id="nivelMissao" value="0" min="0">
                            <button class="btn btn-outline-secondary" type="button" onclick="incrementar()">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="quantidadePlayers" placeholder="Número de Jogadores" required>
                <label for="quantidadePlayers">Quantidade de Jogadores</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="descricaoMissao" rows="4" placeholder="Descreva a missão..."></textarea>
                <label for="descricaoMissao">Descrição (opcional)</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Criar Missão</button>
        </form>
    </div>

    <script>
        function incrementar() {
            let nivelInput = document.getElementById('nivelMissao');
            nivelInput.value = parseInt(nivelInput.value) + 1;
        }

        function decrementar() {
            let nivelInput = document.getElementById('nivelMissao');
            if (parseInt(nivelInput.value) > 0) {
                nivelInput.value = parseInt(nivelInput.value) - 1;
            }
        }
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
