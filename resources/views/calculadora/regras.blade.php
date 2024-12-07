@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Sobre o RPG</h1>
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
@endsection

