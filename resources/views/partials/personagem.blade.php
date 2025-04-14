@if (session('personagem_selecionado'))
    @php
        $personagem = \App\Models\Personagem::find(session('personagem_selecionado'));
        $nivel = \App\Models\Level::where('personagem_id', $personagem->id)->latest()->first();
    @endphp

    @if ($personagem)
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ $personagem->imagem ? asset($personagem->imagem) : 'https://via.placeholder.com/30' }}" class="rounded-circle me-2" alt="Icone do Personagem" style="width: 30px; height: 30px;">
                    <strong class="me-auto">{{ $personagem->nome }}</strong>
                    <small>{{ $nivel ? 'Nível ' . $nivel->nivel : 'Nível N/A' }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Lembrete que você está utilizando o/a {{ $personagem->nome }}.
                </div>
            </div>
        </div>
    @endif
@endif
