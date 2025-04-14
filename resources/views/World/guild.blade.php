@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">{{ $guild['name'] }}</h1>
    <p class="text-center">{{ $guild['description'] }}</p>

    <!-- Imagem da Guilda -->
    <div class="text-center mb-4">
        <img src="{{ $guild['image'] }}" alt="Imagem da {{ $guild['name'] }}" class="img-fluid rounded">
    </div>

    <!-- Botões de interação -->
    <div class="row justify-content-center mb-4">
        <!-- Botão para ver missões -->
        <div class="col-md-3">
            <button class="btn btn-outline-success w-100" data-toggle="modal" data-target="#missaoModal">
                Ver Missões
            </button>
        </div>
        <!-- Botão para se juntar à guilda -->
        <div class="col-md-3">
            <button class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#joinGuildModal">
                Juntar-se à Guilda
            </button>
        </div>
    </div>

    <!-- Modais -->
    <!-- Modal Missões -->
    <div class="modal fade" id="missaoModal" tabindex="-1" role="dialog" aria-labelledby="missaoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missaoModalLabel">Missões Disponíveis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Em breve, missões estarão disponíveis para essa guilda.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Juntar-se à Guilda -->
    <div class="modal fade" id="joinGuildModal" tabindex="-1" role="dialog" aria-labelledby="joinGuildModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinGuildModalLabel">Juntar-se à Guilda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Você agora faz parte da guilda de {{ $guild['name'] }}. Prepare-se para a aventura!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
