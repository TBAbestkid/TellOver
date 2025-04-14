@extends('layouts.game')
@section('content')
<style>
    /* Estilo de carregamento */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Para o Sistemna solar da pagina de systemsolar*/
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: black;
        overflow: hidden;
        background-image: url('https://img.freepik.com/free-photo/space-galaxy-background_53876-93121.jpg?t=st=1736188851~exp=1736192451~hmac=4cedfffca369e8c2d158bd2e046a2cadad04dfa8b96dfcd399859ffa80efc8d3&w=900');
        background-size: cover;
        background-position: center;
        transition: background-color 0.3s ease;
    }

    body::before {
        content: none !important;
    }
    .navbar {
        display: none !important;
    }

    .container-game {
        font-size: 10px;
        width: 640px;
        height: 640px;
        position: relative;
        transition: transform 1s ease; /* Transição suave para o zoom */
        transform-origin: center center; /* Ponto de origem do zoom */
        overflow: hidden;
    }

    .container-game.zoomed {
        transform: scale(2); /* Aumenta o tamanho do contêiner */
    }

    .sun {
        position: absolute;
        top: 240px;
        left: 240px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background-color: yellow;
        box-shadow: 0 0 1.5em white;
    }

    .earth-orbit {
        position: absolute;
        top: 80px;
        left: 80px;
        width: 480px;
        height: 480px;
        animation: orbit 36.5s linear infinite; /* Animação da órbita da Terra */
        pointer-events: none; /* Impede clique na órbita */
        transition: transform 1s ease; /* Transição suave do zoom */
        border-style: solid;
        border-color: white transparent transparent transparent;
        border-width: 1.6px 1.6px 0 0;
        border-radius: 50%;
    }

    .earth {
        position: absolute;
        top: 44.8px;
        right: 44.8px;
        width: 48px;
        height: 48px;
        background-color: aqua;
        border-radius: 50%;
        transition: box-shadow 0.3s ease;
        pointer-events: all; /* Permite clicar no círculo da Terra */
    }

    /* Lua */
    .moon {
        top: 12.8px;
        right:  3.2px;
        width: 19.2px;
        height: 19.2px;
        background-color: silver;
        border-radius: 50%;
    }

    /* Órbita da Lua */
    .moon-orbit {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 128px;
        height: 128px;
        transform: translate(-50%, -50%);
        animation: orbit 2.7s linear infinite;
    }

    @keyframes orbit {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    /* Efeito de brilho ao passar o mouse sobre a Terra */
    .earth:hover {
        box-shadow: 0 0 20px 10px rgba(0, 255, 255, 0.8); /* Brilho no círculo */
    }
    .info-box {
        position: absolute;
        bottom: 10%;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 500px;
        padding: 30px;
        background-color: rgba(0, 0, 0, 0.9);
        color: white;
        font-size: 18px;
        border-radius: 15px;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
        text-align: center;
        pointer-events: none;
    }

    .info-box.visible {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .info-box h2 {
        margin: 0;
        font-size: 24px;
        color: #00bfff;
    }

    .info-box p {
        margin: 10px 0;
        line-height: 1.5;
    }
    /* Info Box */
    .info-box button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.5);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .info-box button:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 123, 255, 0.7);
    }

    .info-box button:active {
        transform: scale(1);
    }

</style>
<!-- Spinner de Carregamento -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>
<div id="ocultar">
    <div id="container-game" class="container-game">
        <div class="sun"></div>
        <div class="earth-orbit">
            <div class="earth" onclick="earthClicked()">
                <div class="moon-orbit">
                    <div class="moon"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Info Box -->
    <div id="infoBox" class="info-box">
        <h2>Bem-vindo a Gukin!</h2>
        <p>
            Gukin, um planeta repleto de vida e mistérios, é lar de diversas civilizações e especies.
            E por algum acaso... você chegou até aqui.
        </p>
        <button onclick="enterPlanet()">Entrar</button>
    </div>
</div>
<!-- Música de fundo -->
<audio id="background-music" loop>
    <source src="{{ asset('audio/moonlight.mp3') }}" type="audio/mpeg">
    Seu navegador não suporta o elemento de áudio.
</audio>
<!-- Bootstrap JS (se necessário) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    let zoomed = false; // Variável para controlar o estado do zoom
    let container = document.getElementById('container-game'); // Container que contém a animação
    let earth = document.querySelector('.earth'); // Seleciona a Terra
    let infoBox = document.getElementById('infoBox'); // Caixa de informações
    let loadingOverlay = document.getElementById('loadingOverlay'); // Overlay de carregamento

    // Função chamada quando a Terra é clicada
    function earthClicked() {
        // Alterna o zoom da Terra
        zoomed = !zoomed;

        if (zoomed) {
            // Se o zoom estiver ativado, aplica o zoom
            container.classList.add('zoomed');
            infoBox.classList.add('visible');
        } else {
            // Caso contrário, remove o zoom
            container.classList.remove('zoomed');
            container.style.transformOrigin = 'center center'; // Resetar o ponto de origem
            infoBox.classList.remove('visible');
        }
    }

    function updateZoomOrigin() {
        // Atualiza a posição do ponto de origem do zoom de acordo com a Terra
        let earthRect = earth.getBoundingClientRect();
        let centerX = earthRect.left + earthRect.width / 2;
        let centerY = earthRect.top + earthRect.height / 2;

        // Ajusta o ponto de origem para o centro da Terra
        container.style.transformOrigin = `${centerX}px ${centerY}px`;
    }

    // Atualiza a origem do zoom a cada quadro
    function update() {
        if (zoomed) {
            updateZoomOrigin();
        }
        requestAnimationFrame(update);
    }

    // Inicia a atualização contínua
    update();

    function enterPlanet() {
        // Oculta o conteúdo inicial
        const container = document.getElementById('ocultar');
        container.style.transition = "opacity 1s ease-out"; // Efeito suave de desaparecimento
        container.style.opacity = "0"; // Esconde a div lentamente

        // Adiciona um delay antes de remover o conteúdo
        setTimeout(function () {
            container.style.display = 'none'; // Remove a div do fluxo após a animação
        }, 1000); // Atraso de 1 segundo após o fade-out

        // Criação do efeito de portal
        let portalEffect = document.createElement("div");
        portalEffect.style.position = "fixed";
        portalEffect.style.top = "0";
        portalEffect.style.left = "0";
        portalEffect.style.width = "100vw";
        portalEffect.style.height = "100vh";
        portalEffect.style.background = "radial-gradient(circle, rgba(255,255,255,0.8), rgba(0,0,0,0.8))";
        portalEffect.style.zIndex = "1000";
        portalEffect.style.transition = "all 2s ease-out";
        document.body.appendChild(portalEffect);

        // Animação de portal e início da narrativa
        setTimeout(function () {
            portalEffect.style.transform = "scale(1.5)";
            portalEffect.style.opacity = "0";

            // Remover o efeito de portal após a animação
            setTimeout(function () {
                document.body.removeChild(portalEffect);

                // Inicia a narrativa após o efeito do portal
                displayNarrationInParts();
            }, 1000); // Espera o portal desaparecer antes de iniciar a narrativa
        }, 1000); // Tempo antes do portal começar a se expandir
    }

    function displayNarrationInParts() {
        const narrationParts = [
            "O sussurro do além ecoa através das eternidades...",

            "Você chegou a Gukin, um planeta distante onde as leis do universo se curvam à força do inesperado.",

            "Aqui, a diversidade não é apenas uma característica — é essência.",

            "Criaturas de todos os cantos do cosmos encontram refúgio neste mundo...",

            "Gukin é mais do que um lugar; é um renascimento.",

            "Sua antiga vida se desfaz, seu passado morre.",

            "Mas, das cinzas, uma nova jornada nasce.",

            "Sua alma foi atraída até este planeta em busca de algo maior...",

            "Uma nova era, um recomeço, ou talvez, a chance de escrever um destino ainda não traçado.",

            "Um mecanismo misterioso conhecido como <strong>The Afterline Engine</strong> permite que cada ser deixe para trás o peso do que foi, oferecendo uma nova chance.",

            "Ao atravessar este portal, você abandona as correntes do que já não é e desperta para o que pode ser.",

            "Bem-vindo a Gukin. O futuro é incerto, mas suas escolhas serão a força que moldará o que está por vir."
        ];

        let currentPart = 0;
        let narration; // Referência ao elemento de narrativa ativo
        let autoAdvance; // Referência ao intervalo automático

        // Função para mostrar a próxima parte da narrativa
        function showNextPart() {
            if (currentPart >= narrationParts.length) return;

            // Remove a narrativa anterior (se existir)
            if (narration) document.body.removeChild(narration);

            // Cria o novo elemento de narrativa
            narration = document.createElement("div");
            narration.style.position = "fixed";
            narration.style.top = "50%";
            narration.style.left = "50%";
            narration.style.transform = "translate(-50%, -50%)";
            narration.style.fontSize = "24px";
            narration.style.color = "#e0e0e0";
            narration.style.textAlign = "center";
            narration.style.opacity = "0";
            narration.style.transition = "opacity 1s ease-in-out, transform 0.8s ease-out";
            narration.style.fontFamily = "'Arial', sans-serif";
            narration.innerHTML = narrationParts[currentPart];

            document.body.appendChild(narration);

            // Animação de fade-in
            setTimeout(() => {
                narration.style.opacity = "1";
                narration.style.transform = "translate(-50%, -50%) scale(1.05)";
            }, 100);
        }

        // Avança para a próxima parte da narrativa
        function advanceNarration() {
            if (currentPart < narrationParts.length - 1) {
                currentPart++;
                showNextPart();
            } else {
                // Se chegou ao final da narrativa, chama a função para redirecionar ou executar outra ação
                endNarration();
            }
        }

        // Configuração inicial
        showNextPart();

        // Exibição automática com intervalo aumentado (6 segundos)
        autoAdvance = setInterval(() => {
            advanceNarration();
            if (currentPart >= narrationParts.length - 1) clearInterval(autoAdvance);
        }, 6000);

        // Botão para pular narrativa
        const skipButton = document.createElement("button");
        skipButton.className = "btn btn-danger btn-sm"; // Usando classes do Bootstrap
        skipButton.innerHTML = `<i class="fas fa-arrow-right"></i> Pular`; // Ícone da seta do Font Awesome
        skipButton.style.position = "fixed";
        skipButton.style.top = "10px";
        skipButton.style.right = "10px";
        skipButton.style.zIndex = "1001";
        skipButton.style.padding = "10px 15px";
        skipButton.style.color = "#fff";
        skipButton.style.border = "none";
        skipButton.style.borderRadius = "50px"; // Botão redondo
        skipButton.style.cursor = "pointer";
        skipButton.onclick = () => {
            clearInterval(autoAdvance); // Cancela o auto-avance
            currentPart = narrationParts.length; // Finaliza a narrativa
            if (narration) document.body.removeChild(narration);
        };
        document.body.appendChild(skipButton);

        // Mensagem informativa no canto inferior
        const infoMessage = document.createElement("div");
        infoMessage.innerText = "Pressione espaço ou clique avançar mais rápido.";
        infoMessage.style.position = "fixed";
        infoMessage.style.bottom = "10px";
        infoMessage.style.right = "10px";
        infoMessage.style.fontSize = "14px";
        infoMessage.style.color = "#fff";
        infoMessage.style.zIndex = "1001";
        infoMessage.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
        infoMessage.style.padding = "5px 10px";
        infoMessage.style.borderRadius = "5px";
        document.body.appendChild(infoMessage);

        // Eventos para avançar manualmente com clique ou tecla
        document.addEventListener("keydown", (event) => {
            if (event.code === "Space") {
                advanceNarration();
                clearInterval(autoAdvance); // Cancela o auto-avance após interação manual
            }
        });

        document.addEventListener("click", () => {
            advanceNarration();
            clearInterval(autoAdvance); // Cancela o auto-avance após interação manual
        });
    }

    function endNarration() {
        // Remover os elementos da narrativa
        const narration = document.querySelector("div");  // Supondo que a narrativa seja a primeira <div>
        const skipButton = document.querySelector("button");
        const infoMessage = document.querySelector(".info-message"); // Corrigido para buscar pelo id ou classe específica

        if (narration) document.body.removeChild(narration);
        if (skipButton) document.body.removeChild(skipButton);
        if (infoMessage) document.body.removeChild(infoMessage);

        // Redirecionar para a página de introdução após terminar a narrativa
        window.location.replace("/introducao");  // Usando replace para substituir o histórico
    }

</script>
<script>
    window.addEventListener('load', function () {
        // Espera a página carregar completamente
        let loadingOverlay = document.getElementById('loadingOverlay');

        // Define o tempo para a animação do carregamento (exemplo: 2 segundos)
        setTimeout(function () {
            // Após 2 segundos, oculta o overlay de carregamento
            loadingOverlay.style.display = 'none';
        }, 2000); // 2000 milissegundos = 2 segundos
    });

    // Iniciar música ao clicar na página
    document.body.addEventListener('click', function () {
        let audio = document.getElementById('background-music');
        audio.play().then(() => {
            console.log("Música iniciada com sucesso.");
        }).catch(function(error) {
            console.log('Erro ao tentar reproduzir áudio: ', error);
        });
    });
</script>
@endsection
