@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">{{ $region->name }}</h1>
    <p class="text-center">{{ $region->description }}</p>

    <!-- Botões de interação -->
    <div class="row justify-content-center mb-4">
        <!-- Botão para o Hospital -->
        <div class="col-md-3">
            <a href="{{ route('world.hospital', ['id' => $region->id]) }}" class="btn btn-outline-primary w-100">
                Ir ao Hospital
            </a>
        </div>
        <!-- Botão para a Guilda -->
        <div class="col-md-3">
            <a href="{{ route('world.guild', ['id' => $region->id]) }}" class="btn btn-outline-primary w-100">
                Ir à Guilda
            </a>
        </div>
        <!-- Botão para a Loja -->
        <div class="col-md-3">
            <a href="{{ route('world.store', ['id' => $region->id]) }}" class="btn btn-outline-primary w-100">
                Ir a Loja
            </a>
        </div>
    </div>

    <!-- Mapa de fundo da região -->
    <div class="map-container" style="position: relative;">
        <img src="{{ $region->map }}" alt="Mapa de {{ $region->name }}" class="img-fluid" />
    </div>

    <!-- Modais de interação -->
    <!-- Modal Hospital -->
    <div class="modal fade" id="hospitalModal" tabindex="-1" aria-labelledby="hospitalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hospitalModalLabel">Hospital de {{ $region['name'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Aqui você pode curar seus ferimentos e recuperar saúde.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Loja -->
    <div class="modal fade" id="lojaModal" tabindex="-1" aria-labelledby="lojaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lojaModalLabel">Loja de {{ $region['name'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Aqui você pode comprar itens e equipamentos para sua jornada.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.personagem')
@endsection
