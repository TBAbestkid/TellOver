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

    /* Spinner */
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

    body::before {
        content: none !important;
    }
    .navbar {
        display: none !important;
    }
    /* Estilo inicial */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgnD2iy3mpP3XCFuPIXfOy_4ZU7CgcYvDBUQAa32mp4YsgSQP4Eo94AdksoML-Fu6EXg5r9K9i75SrCOdCsvlLUaiO8QRDBE8JVE7PlXaL-4C2RgsOmzUbBq8FuE5twncqjaXLo/s1600/portals_7th_heaven_by_ivany86-d6m22w2.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Arial', sans-serif;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
        transition: background 1.5s ease, opacity 1.5s ease;
    }

    /* Título do capítulo */
    .chapter-title {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        text-align: center;
        z-index: 10000;
        opacity: 0;
        font-size: 3em;
        font-weight: bold;
        color: #ffffff;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        animation: fadeInTitle 2s 2s forwards, fadeOutTitle 2s 6s forwards; /* Atraso na entrada e saída */
    }

    /* Animação de entrada */
    @keyframes fadeInTitle {
        from {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.8);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    /* Animação de saída */
    @keyframes fadeOutTitle {
        from {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        to {
            opacity: 0;
            transform: translate(-50%, -50%) scale(1.2);
        }
    }

    /* Estilo do cartão de narração */
    .narration-card {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        padding: 20px;
        max-width: 80%;
        min-width: 400px; /* Tamanho fixo do card */
        text-align: center;
        transition: opacity 1s ease-in-out; /* Suavidade na transição */
        z-index: 10000;
    }

    @keyframes fadeInCard {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* Container da transição */
    .transition-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10000;
        display: none;
    }

    /* Barras de transição */
    .bar {
        position: absolute;
        width: 100%;
        height: 50%;
        background-color: black;
        transform: translateY(-100%);
        transition: transform 1.5s ease-in-out;
    }

    .bar.top {
        top: 0;
    }

    .bar.bottom {
        bottom: 0;
        transform: translateY(100%);
    }

    /* Animação de entrada */
    .transition-overlay.animate .bar.top {
        transform: translateY(0);
    }

    .transition-overlay.animate .bar.bottom {
        transform: translateY(0);
    }

    /* Transição de opacidade */
    .fade-out {
        opacity: 0;
        pointer-events: none;
    }
</style>

<!-- Spinner de Carregamento -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<!-- Título do Capítulo -->
<div class="chapter-title" id="chapterTitle">
    <h1>Capítulo 1 - The Afterline Engine</h1>
</div>

<!-- Transição -->
<div class="transition-overlay" id="transitionOverlay">
    <div class="bar top"></div>
    <div class="bar bottom"></div>
</div>

@if (session('personagem_selecionado'))
    @php
        // Array de informações do personagem
        $info = [];

        // Determina os pronomes com base no gênero
        $pronome = null;
        if ($personagem->genero) {
            if (strtolower($personagem->genero) === 'masculino') {
                $pronome = "ele";
            } elseif (strtolower($personagem->genero) === 'feminino') {
                $pronome = "ela";
            } else {
                $pronome = "não definido"; // Gênero não identificado
            }
        }

        // Adiciona informações somente se estiverem preenchidas
        if ($personagem->nome) {
            $info[] = "Você se chama " . $personagem->nome;
        }

        if ($personagem->idade) {
            $info[] = "tem " . $personagem->idade . " anos";
        }

        if ($personagem->altura) {
            $info[] = "e mede " . $personagem->altura;
        }

        if ($personagem->genero) {
            if ($pronome !== "não definido") {
                $info[] = "é do gênero " . $personagem->genero;
            } else {
                $info[] = "é do gênero " . $personagem->genero . ". Como você prefere ser chamado(a)?";
            }
        }

        if ($personagem->tipo_monstro) {
            $info[] = "e é " . $personagem->tipo_monstro;
        }

        if ($personagem->personalidade) {
            $info[] = "sua personalidade era assim: " . $personagem->personalidade;
        }

        if ($personagem->gosta) {
            $info[] = "tu gosta de " . $personagem->gosta;
        }

        if ($personagem->nao_gosta) {
            $info[] = "não gosta de " . $personagem->nao_gosta;
        }

        if ($personagem->lugar) {
            $info[] = "você vivia em " . $personagem->lugar;
        }
        if ($personagem->historia) {
            $historia = "E sua história era: " . $personagem->historia;
        }
        if($personagem->historia === null){
            $historia = "E você não se lembra de nada do seu passado. Que bom, por que nem precisava mesmo.";
        }
        // Une as informações em uma frase
        $mensagem = implode(', ', $info) . '.';
    @endphp
@endif
<!-- Cartão de Narração -->
<div class="narration-card" id="narrationCard" style="display: none; opacity: 0;">
    <p id="narrationText">Texto inicial da narração...</p>
</div>

<!-- Sons de Efeitos -->
<audio id="portalSound" src="{{ asset('audio/portal.mp3') }}" preload="auto"></audio>
<audio id="impactSound" src="{{ asset('audio/soundEffectImpact.mp3') }}" preload="auto"></audio>

<!-- Música de fundo -->
<audio id="background-portal" loop>
    <source src="{{ asset('audio/GarbageWorms.mp3') }}" type="audio/mpeg">
    Seu navegador não suporta o elemento de áudio.
</audio>
<!-- Música de fundo -->
<audio id="background-florest" loop>
    <source src="{{ asset('audio/TheMagician.mp3') }}" type="audio/mpeg">
    Seu navegador não suporta o elemento de áudio.
</audio>
<script>
    // Partes da narração
    let narrationParts = [
        "Você sai de um portal com um som tão alto que parece que alguém acabou de ligar um aspirador de pó interdimensional. O ar ao seu redor tem um cheiro estranho... algo entre 'metal velho' e 'terra molhada'. Na sua frente, um mundo novo e completamente maluco, que claramente não está nem aí pra sua chegada.",

        "O portal atrás de você brilha intensamente, como se dissesse: 'Olha só como sou importante!' Mas, ao mesmo tempo, ele exala aquela vibe de 'voltar pra mim? Boa sorte com isso, campeão'.",

        "De repente, sua mente começa a trabalhar e manda memórias claras do seu passado: quem você era, o que fazia, até aquele dia em que esqueceu a toalha no banho. Tudo está ali, intacto. Só tem um detalhe: a cada segundo que você passa olhando para esse mundo esquisito, fica óbvio que sua história de antes não vai ter muita utilidade agora. É como lembrar das regras do Uno numa partida de xadrez: irrelevante, mas confortante.",

        "{{ $mensagem }}",

        "{{ $historia }}",

        "Com essa epifania desconfortável, você olha novamente para o portal. Talvez ele seja a chave! Um jeito de voltar ao que importa! Você corre na direção dele, coração cheio de esperança e, talvez, um pouco de ilusão.",

        "Aí vem o clássico momento 'é sério isso?'",

        "Você dá de cara com o portal. Literalmente. A pancada te faz ver estrelinhas e perceber que ele não só não vai te ajudar.",

        "Como ainda está rindo internamente de você. 'Tsc, tsc, tsc, pobre mortal', parece sussurrar, como aquele amigo que finge ajudar mas só quer te zoar.",

        "Você encosta a testa no portal, derrotado, enquanto ele permanece imóvel, imponente e... teimoso. Fica claro: não tem volta. Nenhum botão mágico vai aparecer, e o portal não está no clima de conversas amigáveis. Você respira fundo e aceita que o único caminho é pra frente.",

        "O portal, apenas permanece ali como se sentisse que já cumpriu seu papel de ser inútil e irritante. Você só pisca para ele, várias e várias vezes, com um pensamento: 'Ah, que fofo! Não vai nem deixar uma porta de emergência?'",

        "Agora só sobra você e esse mundo estranho. O chão é mole em alguns lugares e faz um barulho tipo 'squelch' quando você pisa, o que não ajuda a aliviar a tensão. O vento sopra levemente e parece estar cochichando algo, mas, sinceramente, você prefere não saber o que é.",

        "Você olha para frente e sente aquele misto de medo e excitação. Sim, sua história anterior ainda está na sua cabeça, mas parece mais um arquivo guardado numa gaveta do que algo útil. Agora, tudo depende do que você vai fazer aqui, neste lugar que já começou julgando você.",

        "Sem outra escolha, você dá o primeiro passo. Talvez esse lugar seja mais amigável do que parece... ou talvez não. De qualquer forma, a única coisa a fazer é continuar andando. Boa sorte. Você realmente vai precisar."
    ];

    // Nova parte da narração para o Capítulo 2
    let NarrationPartsTwo = [
        "Você sai do portal e dá de cara com uma grande floresta. O que pode haver além ou o que, você não sabe.",

        "Há muitas incertezas até que você vê e ouve um arbusto se mexer.",

        "Institivamente você se prepara para o pior, mas o que sai de lá é...",

        "Um mero gato preto... Espera... Esse gato é diferente! Ele tem grandes olhos vermelhos.",

        "Você decide ignorá-lo, afinal, ele não parece ser motivo de preocupação.",

        "Você olha para os lados, procurando a origem do som. O gato parece te observar, mas você continua sem saber de onde vem o som. Tudo ao seu redor parece misterioso, até que...",

        "O gato se aproxima um pouco mais e, com um olhar curioso, diz: 'Você é cego?'"
    ];

    let currentPart = 0;
    let isTransitioning = false;

    // Função para atualizar o título do capítulo
    function updateChapterTitle(title) {
        const chapterTitle = document.getElementById('chapterTitle');
        chapterTitle.innerHTML = `<h1>${title}</h1>`;
        chapterTitle.style.display = 'block';
    }

    // Função para trocar de capítulo
    function changeChapter(newTitle, newNarrationParts) {
        updateChapterTitle(newTitle);
        narrationParts = newNarrationParts; // Atualiza as partes da narração para o novo capítulo
        currentPart = 0; // Reinicia a narração
        updateNarration(); // Atualiza a narração para o novo capítulo
    }

    // Função para atualizar a narração
    function updateNarration() {
        const narrationText = document.getElementById('narrationText');
        narrationText.innerHTML = narrationParts[currentPart];

        // Verifica se deve tocar o áudio correspondente
        if (narrationParts[currentPart] === "Você sai de um portal com um som tão alto que parece que alguém acabou de ligar um aspirador de pó interdimensional. O ar ao seu redor tem um cheiro estranho... algo entre 'metal velho' e 'terra molhada'. Na sua frente, um mundo novo e completamente maluco, que claramente não está nem aí pra sua chegada.") {
            document.getElementById('portalSound').play();
        }else if (narrationParts[currentPart] === "Você dá de cara com o portal. Literalmente. A pancada te faz ver estrelinhas e perceber que ele não só não vai te ajudar.") {
            document.getElementById('impactSound').play();
        }

        // console.log("Atualizando narração para: ", narrationParts[currentPart]);
    }

    // Avançar a narração com clique ou espaço
    function advanceNarration() {
        if (isTransitioning || currentPart >= narrationParts.length - 1) return;

        isTransitioning = true;
        currentPart++;
        updateNarration();

        setTimeout(() => {
            isTransitioning = false;
        }, 500); // Pequeno delay para evitar cliques rápidos
    }

    // Finalizar a narração
    function endNarration() {
        const transitionOverlay = document.getElementById('transitionOverlay');
        const body = document.body;

        // Exibir a transição e adicionar a animação
        transitionOverlay.style.display = 'block';
        setTimeout(() => {
            transitionOverlay.classList.add('animate');
        }, 10); // Adiciona um pequeno delay para garantir a renderização

        // Suavizar a troca do fundo
        setTimeout(() => {
            // Reduzir a opacidade do corpo para suavizar a remoção do fundo antigo
            body.classList.add('fade-out');

            // Alterar o fundo após o fade-out
            setTimeout(() => {
                // Trocar o fundo
                body.style.background = "url('/storage/images/florestaGzat.jpg') no-repeat center center fixed";
                body.style.backgroundSize = 'cover';

                // Restaurar a opacidade após a troca
                body.classList.remove('fade-out');

                // Ocultar as barras após a transição
                transitionOverlay.classList.remove('animate');
                transitionOverlay.style.display = 'none';

                console.log("Narração concluída e fundo alterado com suavidade!");
                changeChapter("Capítulo 2 - O que é esse lugar?", NarrationPartsTwo);
                console.log(NarrationPartsTwo);
            }, 2000); // Tempo para o fade-out
        }, 3000); // Tempo para a animação das barras
    }

    // Inicializar narração
    function initializeNarration() {
        updateNarration();

        const backgroundMusic = document.getElementById('background-portal');
        backgroundMusic.play();

        // Evento de pressionar a tecla de espaço ou clique
        window.addEventListener('keydown', function (event) {
            if (event.key === " " || event.key === "Spacebar") { // Tecla espaço
                if (currentPart < narrationParts.length - 1) {
                    advanceNarration();
                } else {
                    endNarration();
                }
            }backgroundMusic.play();
        });

        // Evento de clique para avançar a narração
        document.addEventListener('click', function () {
            if (currentPart < narrationParts.length - 1) {
                advanceNarration();
            } else {
                endNarration();
            }backgroundMusic.play();
        });
    }
    // Função para exibir o título e depois os cards
    function displayTitleAndCards() {
        const chapterTitle = document.getElementById('chapterTitle');
        const narrationCard = document.getElementById('narrationCard');

        // Exibir o título
        chapterTitle.style.display = 'block';

        // Aguardar o tempo da animação de saída do título
        setTimeout(() => {
            chapterTitle.style.display = 'none';

            // Exibir o cartão de narração com suavidade
            narrationCard.style.display = 'block';
            setTimeout(() => {
                narrationCard.style.opacity = 1;
            }, 50); // Pequeno atraso para suavizar a transição
        }, 6000); // Tempo total do título (entrada + saída)
    }

    // Evento de carregamento da página
    window.onload = function () {
        const loadingOverlay = document.getElementById('loadingOverlay');

        // Simular um carregamento antes de exibir a narrativa
        setTimeout(() => {
            // Remover o spinner de carregamento
            loadingOverlay.style.display = 'none';

            // Aguardar um tempo extra antes de exibir o título e os cards
            setTimeout(() => {
                displayTitleAndCards();  // Chama a função que exibe o título e os cards

                // Inicializar a narrativa
                initializeNarration();
            }, 2000); // Tempo extra antes do título aparecer
        }, 2000); // Tempo do spinner de carregamento desaparecer
    };

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
</script>
@endsection
