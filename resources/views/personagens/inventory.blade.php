@extends('layouts.app')

@section('content')
<!-- Exibição de Inventário -->
<h2 class="text-center mb-4">Inventário de {{ $personagem->nome }}</h2>

<div class="row mt-5">
    <!-- Lado Esquerdo: Inventário -->
    <div class="col-lg-9">
        <h3 class="text-center">Inventário</h3>
        <div class="d-flex flex-wrap justify-content-start border p-4 rounded shadow-sm"
            style="gap: 10px; background-color: #f8f9fa; min-height: 500px;">
            @for ($i = 0; $i < 40; $i++) <!-- Ajustamos para 5x8 -->
                @php
                    $item = $inventario->get($i); // Obtém o item correspondente ao slot, se existir
                @endphp
                <div class="d-flex align-items-center justify-content-center border rounded bg-light"
                    style="width: 80px; height: 80px; position: relative;">
                    @if ($item)
                        <img src="{{ $item->imagem }}" alt="{{ $item->nome }}"
                            class="img-fluid rounded" style="max-width: 100%; max-height: 100%;">
                        <form action="{{ route('equipItem', ['personagemId' => $personagem->id]) }}" method="POST"
                            style="position: absolute; top: 5px; right: 5px;">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-sm btn-success">+</button>
                        </form>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <!-- Lado Direito: Equipamentos -->
    <div class="col-lg-3">
        <h3 class="text-center">Equipamentos</h3>
        <div class="border p-3 rounded shadow-sm" style="background-color: #f8f9fa;">
            @foreach(['cabeça', 'pescoço', 'costas', 'torso', 'mãos', 'pés'] as $local)
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <strong>{{ ucfirst($local) }}:</strong>
                    @if ($equipamento = $personagem->equipamentos->where('local', $local)->first())
                        <div class="d-flex align-items-center">
                            <img src="{{ $equipamento->item->imagem }}" alt="{{ $equipamento->item->nome }}"
                                 class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                            <span>{{ $equipamento->item->nome }}</span>
                        </div>
                    @else
                        <span class="text-muted">Nenhum item equipado</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection

@section('styles')
<style>
   /* Espaçamento e layout do inventário */
    .d-flex.flex-wrap {
        gap: 10px;
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
    }

    /* Estilo dos slots */
    div[style*="width: 80px"] {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        transition: background-color 0.2s ease;
    }

    div[style*="width: 80px"]:hover {
        background-color: #dee2e6;
        cursor: pointer;
    }

    /* Container geral do inventário */
    .border.p-4 {
        min-height: 500px; /* Altura mínima ajustada para o layout */
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
