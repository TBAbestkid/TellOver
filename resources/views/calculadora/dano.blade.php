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
<!-- Adicao de coment -->
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
