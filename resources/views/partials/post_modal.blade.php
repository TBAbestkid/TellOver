<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="postModalLabel">
                    <i class="fas fa-pen"></i> Novo post
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" id="postForm">
                    @csrf

                    {{-- Campo de texto --}}
                    <div class="mb-2">
                        <textarea
                            class="form-control border-0 shadow-sm @error('body') is-invalid @enderror"
                            id="textoPost"
                            name="body"
                            rows="4"
                            style="resize: none; font-size: 1.1rem;"
                            placeholder="No que você está pensando?"
                            required
                        >{{ old('body') }}</textarea>
                        @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contador de caracteres --}}
                    <div class="text-end small text-muted mb-2">
                        <span id="contadorCaracteres">500</span> caracteres restantes
                    </div>

                    {{-- Barra inferior com ícones --}}
                    <div class="d-flex justify-content-between align-items-center border rounded p-2 px-3 mb-3 bg-light">
                        <div class="d-flex gap-3 align-items-center">
                            {{-- Input múltiplo --}}
                            <input type="file" id="imagemInput" name="images[]" accept="image/*" multiple hidden>

                            {{-- Ícone para abrir o seletor --}}
                            <label for="imagemInput" class="m-0 text-primary" style="cursor: pointer;">
                                <i class="fas fa-image fs-5"></i>
                            </label>

                            {{-- Placeholder icons --}}
                            <span class="text-muted" style="cursor: not-allowed;">
                                <i class="fas fa-gift fs-5"></i>
                            </span>
                            <span class="text-muted" style="cursor: not-allowed;">
                                <i class="fas fa-smile fs-5"></i>
                            </span>
                        </div>

                        {{-- Visibilidade --}}
                        <select class="form-select form-select-sm w-auto" name="visibility" style="min-width: 140px;">
                            <option value="public">🌍 Público</option>
                            <option value="friends">👥 Amigos</option>
                            <option value="private">🔒 Privado</option>
                        </select>
                    </div>

                    {{-- Exibição de imagem --}}
                    <div class="mb-3" id="previewWrapper" style="display: none; gap: 8px; flex-wrap: wrap;"></div>

                    {{-- Permitir comentários --}}
                    <div class="form-check mb-3">
                        <input type="hidden" name="allow_comments" value="0">
                        <input class="form-check-input" type="checkbox" id="allow_comments" name="allow_comments" value="1" checked>
                        <label class="form-check-label small" for="allow_comments">
                            Permitir comentários neste post
                        </label>
                    </div>

                    {{-- Botão Publicar --}}
                    <button type="submit" class="btn btn-success w-100 fw-bold" id="btnPublicar" disabled>
                        <i class="fas fa-paper-plane me-1"></i> Publicar
                    </button>
                </form>

                {{-- Saída formatada (apenas para testes) --}}
                <div id="saidaPostagem" class="mt-3 d-none"></div>
            </div>

            <div class="modal-footer justify-content-between">
                <small class="text-muted">Você pode editar ou apagar este post depois.</small>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Fechar
                </button>
            </div>
        </div>
    </div>
</div>
