@extends('layouts.app')

@section('content')
<div class="container mt-5">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center">Criar Personagem</h2>
            <form id="characterForm" method="POST" action="{{ route('criarpersonagem.post') }}" onsubmit="return validateStep1()">
                @csrf
                <!-- Etapa 1: Informações Básicas -->
                <div id="step1" class="form-step">
                    <h4>Informações Básicas</h4>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        <label for="nome">Nome <span class="text-danger">*</span></label>
                        <small id="nomeError" class="text-danger" style="display:none;">Este campo é obrigatório.</small>
                    </div>

                    <div class="form-row">
                        <div class="col form-floating mb-3">
                            <input type="number" class="form-control" id="idade" name="idade" placeholder="Idade">
                            <label for="idade">Idade <i class="fas fa-calendar-alt"></i></label>
                        </div>
                        <div class="col form-floating mb-3">
                            <input type="text" class="form-control" id="altura" name="altura" placeholder="Altura">
                            <label for="altura">Altura <i class="fas fa-arrows-alt-v"></i></label>
                        </div>
                        <div class="col form-floating mb-3">
                            <input type="text" class="form-control" id="tipoMonstro" name="tipoMonstro" placeholder="Raça">
                            <label for="raca">Raça <i class="fas fa-dragon"></i></label>
                        </div>
                    </div>

                    <!-- Botão Próximo -->
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Próximo</button>
                </div>
                <!-- Etapa 2: Seleção de Habilidades -->
                <div id="step2" class="form-step" style="display: none;">
                    <h4>Seleção de Habilidades</h4>
                    <div id="habilidadesSelection">
                        <select id="habilidades" multiple="multiple" style="width: 100%;">
                            <optgroup label="Habilidades">
                                <option value="forca">Força</option>
                                <option value="velocidade">Velocidade</option>
                                <option value="precisao">Precisão</option>
                                <option value="vida">Vida</option>
                                <option value="multi_ataque">Multi Ataque</option>
                                <option value="regeneracao">Regeneração</option>
                                <option value="cura">Cura</option>
                                <option value="vampirismo">Vampirismo</option>
                                <option value="teleporte_global">Teleporte Global</option>
                                <option value="teleporte_curto">Teleporte Curto</option>
                                <option value="armadura_fisica">Armadura Física</option>
                                <option value="armadura_magica">Armadura Mágica</option>
                                <option value="armadura_elemental">Armadura Elemental</option>
                            </optgroup>
                            <optgroup label="Cineses">
                                <option value="pyrocinese">Pyrocinese</option>
                                <option value="hidrocinese">Hidrocinese</option>
                                <option value="criocinese">Criocinese</option>
                                <option value="geocinese">Geocinese</option>
                                <option value="metalocinese">Metalocinese</option>
                                <option value="fumocinese">Fumocinese</option>
                                <option value="fitocinese">Fitocinese</option>
                                <option value="photocinese">Photocinese</option>
                                <option value="umbracinese">Umbracinese</option>
                                <option value="telecinese">Telecinese</option>
                                <option value="aerocinese">Aerocinese</option>
                                <option value="eletrocinese">Eletrocinese</option>
                                <option value="hemocinese">Hemocinese</option>
                                <option value="acidumcinese">Acidumcinese</option>
                                <option value="venocinese">Venocinese</option>
                                <option value="aethercinese">Aethercinese</option>
                            </optgroup>
                        </select>

                        <small class="form-text text-muted">Selecione até 3 habilidades.</small>
                        <div id="habilidadesError" style="display: none; color: red;">
                            <small>Selecione pelo menos uma habilidade</small>
                        </div><br>

                        <!-- Botão Criar Personagem -->
                        <button type="button" class="btn btn-secondary" onclick="nextStep(1)">Anterior</button>
                        <button type="submit" class="btn btn-success">Criar Personagem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Habilidades -->
<div class="modal fade" id="confirmarModal" tabindex="-1" aria-labelledby="confirmarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarModalLabel">Você tem certeza?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você selecionou poucas habilidades. Deseja continuar com o número atual de habilidades ou selecionar mais para alcançar o total de 3?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmarEscolha">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Popper.js e Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Função para avançar/retroceder nas etapas
    function nextStep(step) {
        console.log("Tentando avançar para a etapa:", step);

        // Exibir a etapa correta e ocultar as demais
        document.querySelectorAll('.form-step').forEach(stepDiv => {
            stepDiv.style.display = 'none';
        });
        document.getElementById(`step${step}`).style.display = 'block';
    }

    // Validação para a Etapa 1
    function validateStep1() {
        const nome = $('#nome').val().trim();
        if (!nome) {
            $('#nomeError').show();
            return false; // Impede avançar
        } else {
            $('#nomeError').hide();
            return true; // Permite avançar
        }
    }

    // Validação para a Etapa 2 (Seleção de Habilidades)
    function validateStep2() {
        const habilidades = $('#habilidades').val();
        const habilidadesCount = habilidades ? habilidades.length : 0;

        // Se o usuário não selecionou habilidades, não mostramos o modal aqui
        if (habilidadesCount === 0) {
            return false; // Impede avançar, mas não mostra o modal
        }

        // Se houver 1 ou mais habilidades, avançar normalmente
        return true;
    }

    // Esta função será chamada ao clicar em "Criar Personagem" para validar antes de enviar
    $('#characterForm').submit(function(event) {
        const habilidades = $('#habilidades').val();
        const habilidadesCount = habilidades ? habilidades.length : 0;

        // Se o número de habilidades for 0, exibe o modal
        if (habilidadesCount === 0) {
            event.preventDefault(); // Impede o envio do formulário
            $('#confirmarModal').modal('show');
        }
    });

    // Confirmar a escolha no modal
    $('#confirmarEscolha').click(function() {
        $('#confirmarModal').modal('hide');
        // Agora, envia o formulário após o usuário confirmar
        $('#characterForm').submit();
    });

    // Inicialização do Select2
    $(document).ready(function() {
        $('#habilidades').select2({
            placeholder: "Selecione até 3 habilidades",
            maximumSelectionLength: 3
        });
        console.log("Select2 inicializado");
    });
</script>
@endsection
