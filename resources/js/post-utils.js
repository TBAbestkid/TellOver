console.log('post-utils.js carregado');

// ======= Contador de Caracteres com feedback visual =======
document.querySelector('#textoPost')?.addEventListener('input', function () {
    const max = 500;
    const contador = document.querySelector('#contadorCaracteres');
    const restante = max - this.value.length;

    contador.textContent = `${restante}`;
    contador.style.color = restante < 0 ? 'red' : restante < 30 ? 'orange' : 'inherit';
});

// ======= Detecção e destaque de @usuário e #tag (ao enviar ou em tempo real se preferir) =======
function formatarTexto(texto) {
    // Links primeiro
    texto = texto.replace(
        /(https?:\/\/[^\s]+)/g,
        '<a href="$1" target="_blank" class="auto-link">$1</a>'
    );

    // Mencionar usuários
    texto = texto.replace(
        /@([a-zA-Z0-9_]+)/g,
        '<span class="marcacao-usuario">@$1</span>'
    );

    // Hashtags
    texto = texto.replace(
        /#([a-zA-Z0-9_]+)/g,
        '<span class="marcacao-tag">#$1</span>'
    );

    return texto;
}

// Exemplo de uso após postar:
function mostrarPostFormatado() {
    const campoTexto = document.querySelector('#textoPost');
    const saida = document.querySelector('#saidaPostagem');
    if (campoTexto && saida) {
        saida.innerHTML = formatarTexto(campoTexto.value);
    }
}

// ======= Botão de Publicar Ativo apenas com texto ou imagem =======
function atualizarBotaoPublicar() {
    const texto = document.querySelector('#textoPost')?.value.trim();
    const imagem = document.querySelector('#imagemInput')?.files.length > 0;
    const botao = document.querySelector('#btnPublicar');
    botao.disabled = !(texto || imagem);
}

document.querySelector('#textoPost')?.addEventListener('input', atualizarBotaoPublicar);
document.querySelector('#imagemInput')?.addEventListener('change', atualizarBotaoPublicar);

// ======= Remover imagem selecionada =======
document.querySelector('#removerImagem')?.addEventListener('click', function () {
    const input = document.querySelector('#imagemInput');
    const preview = document.querySelector('#imagemPreview');
    input.value = '';
    preview.src = '';
    preview.style.display = 'none';
    atualizarBotaoPublicar();
});

// ======= Multipla imagem em postagens e Pré-visualização da Imagem =======
const MAX_IMAGENS = 4;

const imagemInput = document.getElementById('imagemInput');
const previewWrapper = document.getElementById('previewWrapper');
const btnPublicar = document.querySelector('#btnPublicar');
const campoTexto = document.querySelector('#textoPost');

function atualizarPreviewImagens() {
    const arquivos = Array.from(imagemInput.files);

    previewWrapper.innerHTML = '';
    previewWrapper.style.display = arquivos.length ? 'flex' : 'none';

    const row = document.createElement('div');
    row.className = 'row w-100 g-2';

    arquivos.slice(0, MAX_IMAGENS).forEach((file, index) => {
        const col = document.createElement('div');
        col.className = 'col-6 col-md-3 position-relative';

        const reader = new FileReader();
        reader.addEventListener('load', function () {
            const img = document.createElement('img');
            img.src = reader.result;
            img.className = 'img-fluid rounded shadow-sm';
            img.style.maxHeight = '150px';

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = '&times;';
            btn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle px-2 py-0';
            btn.style.zIndex = '2';
            btn.title = 'Remover imagem';
            btn.onclick = () => removerImagem(index);

            col.appendChild(img);
            col.appendChild(btn);
            row.appendChild(col);
        });

        reader.readAsDataURL(file);
    });

    previewWrapper.appendChild(row);

    if (arquivos.length > MAX_IMAGENS) {
        alert(`Você só pode adicionar até ${MAX_IMAGENS} imagens.`);
        imagemInput.value = '';
        previewWrapper.style.display = 'none';
    }

    atualizarBotaoPublicar();
}

function removerImagem(index) {
    const arquivos = Array.from(imagemInput.files);
    arquivos.splice(index, 1);

    // Criar um novo DataTransfer com os arquivos restantes
    const dt = new DataTransfer();
    arquivos.forEach(file => dt.items.add(file));
    imagemInput.files = dt.files;

    atualizarPreviewImagens();
}

imagemInput?.addEventListener('change', atualizarPreviewImagens);
campoTexto?.addEventListener('input', atualizarBotaoPublicar);

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector('#imagemInput');
    const preview = document.querySelector('#imagemPreview');

    if (!input || !preview) return;

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
});

