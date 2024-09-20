@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Calculadora de Dano</h1>
    
    <form id="damage-calculator-form">
        <!-- Atributos do Personagem -->
        <div class="mb-3">
            <label for="forca" class="form-label">Força</label>
            <input type="number" class="form-control" id="forca" name="forca" placeholder="Insira a força do personagem" required>
        </div>

        <div class="mb-3">
            <label for="agilidade" class="form-label">Agilidade</label>
            <input type="number" class="form-control" id="agilidade" name="agilidade" placeholder="Insira a agilidade do personagem" required>
        </div>

        <div class="mb-3">
            <label for="precisao" class="form-label">Precisão</label>
            <input type="number" class="form-control" id="precisao" name="precisao" placeholder="Insira a precisão do personagem" required>
        </div>

        <!-- Outros campos de atributos podem ser adicionados aqui -->
        
        <button type="submit" class="btn btn-primary">Calcular Dano</button>
    </form>

    <!-- Resultado -->
    <div id="result" class="mt-4"></div>
</div>

<script>
    document.getElementById('damage-calculator-form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Coleta dos valores
        const forca = document.getElementById('forca').value;
        const agilidade = document.getElementById('agilidade').value;
        const precisao = document.getElementById('precisao').value;

        // Exemplo de cálculo simples de dano (pode ser ajustado conforme o sistema)
        const dano = (parseInt(forca) * 2) + (parseInt(agilidade) * 1.5) + (parseInt(precisao) * 1.2);

        // Exibe o resultado
        document.getElementById('result').innerHTML = `<h2>Dano Total: ${dano}</h2>`;
    });
</script>
@endsection
