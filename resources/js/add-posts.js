document.addEventListener('DOMContentLoaded', function () {
    const postForm = document.getElementById('postForm');
    const postModal = new bootstrap.Modal(document.getElementById('postModal'));
    const postFeed = document.getElementById('postFeed');
    const btnPublicar = document.getElementById('btnPublicar');

    postForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(postForm);
        btnPublicar.disabled = true;
        btnPublicar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Publicando...';

        try {
            const response = await fetch(postForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            });

            if (!response.ok) {
                const errText = await response.text();
                try {
                    const errJson = JSON.parse(errText);
                    console.error("Erro detalhado:", errJson);
                } catch (e) {
                    console.error("Erro bruto retornado:", errText);
                }
                throw new Error("Resposta inválida do servidor.");
            }

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                throw new Error('Esperado JSON, veio: ' + text);
            }

            const data = await response.json();
            // console.log('Resposta JSON:', data);

            if (data.html) {
                postFeed.insertAdjacentHTML('afterbegin', data.html);
                postForm.reset(); // limpa o form
                document.getElementById('previewWrapper').innerHTML = '';
                document.getElementById('previewWrapper').style.display = 'none';
                postModal.hide(); // fecha o modal
            }
        } catch (err) {
            alert('Erro ao publicar post. Tente novamente.');
            console.error(err);
        } finally {
            btnPublicar.disabled = false;
            btnPublicar.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Publicar';
        }
    });
});
