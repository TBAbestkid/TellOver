@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center">Criar Personagem</h2>
            <form id="characterForm">
                <!-- Informações Básicas -->
                <div id="basicInfo">
                    <div class="form-group">
                        <label for="nome">Nome <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="idade">Idade <i class="fas fa-calendar-alt"></i></label>
                            <input type="number" class="form-control" id="idade" placeholder="Idade">
                        </div>
                        <div class="form-group col">
                            <label for="altura">Altura <i class="fas fa-arrows-alt-v"></i></label>
                            <input type="text" class="form-control" id="altura" placeholder="Altura">
                        </div>
                        <div class="form-group col">
                            <label for="tipoMonstro">Raça <i class="fas fa-dragon"></i></label>
                            <input type="text" class="form-control" id="tipoMonstro" placeholder="Raça">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="personalidade">Personalidade <i class="fas fa-smile"></i></label>
                            <input type="text" class="form-control" id="personalidade" placeholder="Personalidade">
                        </div>
                        <div class="form-group col">
                            <label for="genero">Gênero <i class="fas fa-genderless"></i></label>
                            <input type="text" class="form-control" id="genero" placeholder="Gênero">
                        </div>
                        <div class="form-group col">
                            <label for="sexualidade">Sexualidade <i class="fas fa-heart"></i></label>
                            <input type="text" class="form-control" id="sexualidade" placeholder="Sexualidade">
                        </div>
                    </div>

                    <div class="form-group">
                        <h6 class="text-center">◈ ━━━━━━━━ ⸙ ━━━━━━━━ ◈</h6>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="origem">Origem <i class="fas fa-map"></i></label>
                            <input type="text" class="form-control" id="origem" placeholder="Origem">
                        </div>
                        <div class="form-group col">
                            <label for="lugar">Lugar onde vive atualmente <i class="fas fa-map-marker-alt"></i></label>
                            <input type="text" class="form-control" id="lugar" placeholder="Lugar">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="fazParteDeAlgo">Faz parte de algo? <i class="fas fa-users"></i></label>
                            <input type="text" class="form-control" id="fazParteDeAlgo" placeholder="Faz parte de algo?">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="relacaoPersonagens">Relação com outros personagens <i class="fas fa-user-friends"></i></label>
                            <input type="text" class="form-control" id="relacaoPersonagens" placeholder="Relação com outros personagens">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="gosta">Gosta <i class="fas fa-heart"></i></label>
                            <input type="text" class="form-control" id="gosta" placeholder="O que gosta?">
                        </div>
                        <div class="form-group col">
                            <label for="naoGosta">Não gosta <i class="fas fa-thumbs-down"></i></label>
                            <input type="text" class="form-control" id="naoGosta" placeholder="O que não gosta?">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem <i class="fas fa-image"></i></label>
                        <input type="file" class="form-control" id="imagem">
                    </div>

                    <div class="form-group">
                        <label for="historia">História <i class="fas fa-book"></i></label>
                        <textarea class="form-control" id="historia" rows="3" placeholder="Conte a história..."></textarea>
                    </div>
                </div>

                <!-- Formulário de Distribuição de Pontos -->
                <div id="pointsDistribution" style="display: none;">
                    <h5>Distribua 10 Pontos (mínimo 1 ponto por habilidade):</h5>
                    <div class="form-row mb-3">
                        <div class="form-group col">
                            <label for="forca">Força (1-10)</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeValue('forca', -1)">-</button>
                                <input type="number" class="form-control" id="forca" min="1" max="10" value="1" oninput="updatePoints()">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeValue('forca', 1)">+</button>
                            </div>
                            <div class="text-danger" id="forcaError" style="display: none;">Este campo não pode ser zerado.</div>
                        </div>
                        <div class="form-group col">
                            <label for="velocidade">Velocidade (1-10)</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeValue('velocidade', -1)">-</button>
                                <input type="number" class="form-control" id="velocidade" min="1" max="10" value="1" oninput="updatePoints()">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeValue('velocidade', 1)">+</button>
                            </div>
                            <div class="text-danger" id="velocidadeError" style="display: none;">Este campo não pode ser zerado.</div>
                        </div>
                        <div class="form-group col">
                            <label for="precisao">Precisão (1-10)</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeValue('precisao', -1)">-</button>
                                <input type="number" class="form-control" id="precisao" min="1" max="10" value="1" oninput="updatePoints()">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeValue('precisao', 1)">+</button>
                            </div>
                            <div class="text-danger" id="precisaoError" style="display: none;">Este campo não pode ser zerado.</div>
                        </div>
                    </div>
                    <h5 id="pointsRemaining">Pontos restantes: 7</h5>
                    <div class="text-danger" id="pointsWarning"></div>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="nextStep()">Próximo</button>
                </div>
                <button type="submit" class="btn btn-success btn-block" style="display: none;">Criar Personagem</button>
            </form>
        </div>
    </div>
</div>


<script>
    function nextStep() {
        const basicInfo = document.getElementById('basicInfo');
        const pointsDistribution = document.getElementById('pointsDistribution');
        const submitButton = document.querySelector('button[type="submit"]');

        if (basicInfo.style.display !== 'none') {
            basicInfo.style.display = 'none';
            pointsDistribution.style.display = 'block';
            submitButton.style.display = 'none'; // Esconde o botão de envio na primeira parte
        } else {
            // Aqui você pode adicionar validações antes de enviar o formulário
            submitButton.style.display = 'block'; // Mostra o botão de envio na segunda parte
        }
    }

    let totalPoints = 10;
    let usedPoints = 3; // Inicialmente, 1 ponto em cada habilidade

    function updatePoints() {
        // Recalcula os pontos usados
        usedPoints = 0;
        usedPoints += parseInt(document.getElementById('forca').value) || 0;
        usedPoints += parseInt(document.getElementById('velocidade').value) || 0;
        usedPoints += parseInt(document.getElementById('precisao').value) || 0;

        let remainingPoints = totalPoints - usedPoints;
        document.getElementById('pointsRemaining').textContent = `Pontos restantes: ${remainingPoints}`;

        // Limitar os inputs para não permitir valores menores que 1
        const forca = document.getElementById('forca');
        const velocidade = document.getElementById('velocidade');
        const precisao = document.getElementById('precisao');

        forca.value = Math.max(1, Math.min(10, forca.value));
        velocidade.value = Math.max(1, Math.min(10, velocidade.value));
        precisao.value = Math.max(1, Math.min(10, precisao.value));

        // Mostrar/ocultar mensagens de erro
        document.getElementById('forcaError').style.display = forca.value < 1 ? 'block' : 'none';
        document.getElementById('velocidadeError').style.display = velocidade.value < 1 ? 'block' : 'none';
        document.getElementById('precisaoError').style.display = precisao.value < 1 ? 'block' : 'none';

        // Mostrar mensagem se os pontos restantes forem negativos
        if (remainingPoints < 0) {
            document.getElementById('pointsWarning').textContent = "Você não pode usar mais pontos do que o total permitido!";
        } else {
            document.getElementById('pointsWarning').textContent = "";
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
