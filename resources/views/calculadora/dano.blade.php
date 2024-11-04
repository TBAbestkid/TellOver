@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Calculadora de Dano</h1>
    <form id="damage-calculator-form" class="border rounded p-4 shadow mx-auto" style="max-width: 600px;">
        <div class="form-floating mb-3">
            <select class="form-select" id="damageType" required>
                <option value="" disabled selected>Escolha o tipo de dano</option>
                <option value="fisico">Físico</option>
                <option value="magico">Mágico</option>
                <option value="elemental">Elemental</option>
            </select>
            <label for="damageType" class="form-label"><i class="fas fa-fist-raised"></i> Tipo de Dano</label>
        </div>

        <div id="elementalTypeContainer" class="d-none form-floating mb-3">
            <select class="form-select" id="elementalDamageType">
                <option value="" disabled selected>Escolha o tipo de dano elemental</option>
                <option value="fogo">Fogo</option>
                <option value="gelo">Gelo</option>
                <option value="agua">Água</option>
                <option value="veneno">Veneno</option>
                <option value="sombra">Sombra</option>
                <option value="luz">Luz</option>
                <option value="sangue">Sangue</option>
                <option value="eletrico">Elétrico</option>
                <option value="vento">Vento</option>
            </select>
            <label for="elementalDamageType" class="form-label"><i class="fas fa-fire"></i> Tipo de Dano Elemental</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="damageAmount" placeholder="Dano causado" required>
            <label for="damageAmount" class="form-label"><i class="fas fa-damage"></i> Quantidade de Dano</label>
        </div>

        <div id="forceContainer" class="d-none form-floating mb-3">
            <input type="number" class="form-control" id="forceAmount" placeholder="Força usada" min="1">
            <label for="forceAmount" class="form-label"><i class="fas fa-fist-raised"></i> Quantidade de Força</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="armorType" required>
                <option value="" disabled selected>Escolha o tipo de armadura</option>
                <option value="fisica">Física</option>
                <option value="magica">Mágica</option>
                <option value="elemental">Elemental</option>
            </select>
            <label for="armorType" class="form-label"><i class="fas fa-shield-alt"></i> Tipo de Armadura</label>
        </div>

        <div id="elementalArmorType" class="d-none form-floating mb-3">
            <select class="form-select" id="specificElementalType">
                <option value="" disabled selected>Escolha o tipo de defesa elemental específica</option>
                <option value="geral">Geral</option>
                <option value="fogo">Fogo</option>
                <option value="gelo">Gelo</option>
                <option value="agua">Água</option>
                <option value="veneno">Veneno</option>
                <option value="sombra">Sombra</option>
                <option value="luz">Luz</option>
                <option value="sangue">Sangue</option>
                <option value="eletrico">Elétrico</option>
                <option value="vento">Vento</option>
            </select>
            <label for="specificElementalType" class="form-label"><i class="fas fa-shield-alt"></i> Tipo de Defesa Elemental Específica</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="armorAmount" placeholder="Defesa do alvo" required>
            <label for="armorAmount" class="form-label"><i class="fas fa-shield-alt"></i> Quantidade de Armadura</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Calcular Dano</button>
        </div>
    </form>
    <div id="result" class="mt-4 text-center"></div>
</div>

<div class="border rounded p-4 mt-4 mx-auto" style="max-width: 600px;">
    <h5 class="text-center">Sobre o Dano</h5>
    <p>No nosso servidor, as criaturas e personagens causam danos diferentes para ataques diferentes. Isso é, atacar alguém com uma espada é bem diferente de atacar alguém com uma bola de fogo. Vale lembrar também que alguns ataques podem dar mais de um tipo de dano ao mesmo tempo.</p>

    <ul class="list-unstyled">
        <li class="mb-3 p-3 border rounded">
            <h5 class="text-dark"><i class="fas fa-fist-raised"></i> Dano Físico</h5>
            <p>Causado por armas, luta corporal, quedas, colisões, etc. Uma armadura comprada em um ferreiro, ou aumento de resistência são eficazes contra danos físicos.</p>
        </li>

        <li class="mb-3 p-3 border rounded">
            <h5 class="text-dark"></h5><i class="fas fa-magic"></i> Dano Mágico</h5>
            <p>Causado por magias com efeito unicamente arcano, como lampejos de magia. Dano mágico é mais difícil de proteger.</p>
        </li>

        <li class="mb-3 p-3 border rounded">
            <h5 class="text-dark"><i class="fas fa-water"></i> Dano Elemental</h5>
            <p>Causado por forças da natureza, como fogo, eletricidade, frio, luz, veneno, ácido, etc. Geralmente tem resistências específicas.</p>
        </li>

        <li class="mb-3 p-3 border rounded">
            <h5 class="text-dark"><i class="fas fa-exclamation-triangle"></i> Dano Verdadeiro</h5>
            <p>Dano impossível de ser evitado. É banido para se colocar em skills.</p>
        </li>
    </ul>
</div>

<div class="container mt-5">
    <h1 class="text-center">Regras do RP</h1>

    <div class="accordion" id="rulesAccordion">

        <!-- HP e Determinação -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHP">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHP" aria-expanded="true" aria-controls="collapseHP">
                    HP e Determinação
                </button>
            </h2>
            <div id="collapseHP" class="accordion-collapse collapse show" aria-labelledby="headingHP" data-bs-parent="#rulesAccordion">
                <div class="accordion-body">
                    <ul>
                        <li>Começa com 3 de HP.</li>
                        <li>HP = 0: próximo ataque causa dano na determinação.</li>
                        <li>Dano: 1d100, dificuldade aumenta com lesões.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Resistências -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingResistencias">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResistencias" aria-expanded="false" aria-controls="collapseResistencias">
                    Resistências
                </button>
            </h2>
            <div id="collapseResistencias" class="accordion-collapse collapse" aria-labelledby="headingResistencias" data-bs-parent="#rulesAccordion">
                <div class="accordion-body">
                    <ul>
                        <li>Protege contra um tipo de dano.</li>
                        <li>Inicialmente 0, não cura com habilidades de vida.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- HP -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHPDetails">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHPDetails" aria-expanded="false" aria-controls="collapseHPDetails">
                    HP
                </button>
            </h2>
            <div id="collapseHPDetails" class="accordion-collapse collapse" aria-labelledby="headingHPDetails" data-bs-parent="#rulesAccordion">
                <div class="accordion-body">
                    <ul>
                        <li>+HP aumenta lesões antes do risco de morte.</li>
                        <li>HP extra pode ser curado.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Armadura -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingArmadura">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseArmadura" aria-expanded="false" aria-controls="collapseArmadura">
                    Armadura
                </button>
            </h2>
            <div id="collapseArmadura" class="accordion-collapse collapse" aria-labelledby="headingArmadura" data-bs-parent="#rulesAccordion">
                <div class="accordion-body">
                    <ul>
                        <li>Reinicia no início de cada turno.</li>
                        <li>Protege contra danos; pode ser quebrada.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Cineses -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingCineses">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCineses" aria-expanded="false" aria-controls="collapseCineses">
                    Cineses
                </button>
            </h2>
            <div id="collapseCineses" class="accordion-collapse collapse" aria-labelledby="headingCineses" data-bs-parent="#rulesAccordion">
                <div class="accordion-body">
                    <ul>
                        <li>Manipula elementos; força igual à do personagem.</li>
                        <li>Uma cinese por vez, sem multi ataque.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Atributos -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAtributos">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAtributos" aria-expanded="false" aria-controls="collapseAtributos">
                    Atributos
                </button>
            </h2>
            <div id="collapseAtributos" class="accordion-collapse collapse" aria-labelledby="headingAtributos" data-bs-parent="#rulesAccordion">
                <div class="accordion-body">
                    <ul>
                        <li><strong>Força:</strong> Carregar e quebrar guarda.</li>
                        <li><strong>Velocidade:</strong> Desviar e acertar mais facilmente.</li>
                        <li><strong>Mira:</strong> Precisão em alvos distantes.</li>
                        <li><strong>Armadura:</strong> +1 de defesa e guarda.</li>
                        <li><strong>Resistência:</strong> +1 de resistência.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
    // Evento para mudança de tipo de dano
document.getElementById('damageType').addEventListener('change', function() {
    const elementalTypeContainer = document.getElementById('elementalTypeContainer');
    const forceContainer = document.getElementById('forceContainer');

    if (this.value === 'elemental') {
        elementalTypeContainer.classList.remove('d-none');
        forceContainer.classList.add('d-none');
    } else {
        elementalTypeContainer.classList.add('d-none');
        forceContainer.classList.toggle('d-none', this.value !== 'fisico');
    }
});

// Evento para mudança de tipo de armadura
document.getElementById('armorType').addEventListener('change', function() {
    const elementalArmorContainer = document.getElementById('elementalArmorContainer');
    const specificElementalArmorContainer = document.getElementById('specificElementalArmorContainer');

    if (this.value === 'elemental') {
        elementalArmorContainer.classList.remove('d-none');
    } else {
        elementalArmorContainer.classList.add('d-none');
        specificElementalArmorContainer.classList.add('d-none');
    }
});

// Evento para mudança do tipo de armadura elemental
document.getElementById('elementalArmorType').addEventListener('change', function() {
    const specificElementalArmorContainer = document.getElementById('specificElementalArmorContainer');
    
    if (this.value === 'especifica') {
        specificElementalArmorContainer.classList.remove('d-none');
    } else {
        specificElementalArmorContainer.classList.add('d-none');
    }
});

// Evento para calcular o dano
document.getElementById('damage-calculator-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const damageType = document.getElementById('damageType').value;
    const damageAmount = parseInt(document.getElementById('damageAmount').value);
    const armorAmount = parseInt(document.getElementById('armorAmount').value) || 0;
    let result = 0;

    if (damageType === 'fisico') {
        const forceAmount = parseInt(document.getElementById('forceAmount').value) || 0;
        if (forceAmount > 3) {
            result = damageAmount; // Força suficiente para ignorar armadura
        } else {
            result = Math.max(damageAmount - armorAmount, 0);
        }
    } else if (damageType === 'magico') {
        result = Math.max(damageAmount - armorAmount, 0);
    } else if (damageType === 'elemental') {
        const elementalDamageType = document.getElementById('elementalDamageType').value;
        const elementalArmorType = document.getElementById('elementalArmorType').value;
        const specificArmorType = document.getElementById('specificElementalType').value;

        if (elementalArmorType === 'especifica' && elementalDamageType === specificArmorType) {
            result = Math.max(damageAmount - armorAmount, 0);
        } else if (elementalArmorType === 'geral') {
            result = Math.max(damageAmount - armorAmount, 0);
        } else {
            result = damageAmount; // Dano total se não houver resistência
        }
    }

    document.getElementById('result').innerHTML = `<h2>Dano Resultante: ${result}</h2>`;
});

</script>
@endsection
