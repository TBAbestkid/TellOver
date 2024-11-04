@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h4>Lista de Personagens</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Personagem 1
                    <span class="badge text-bg-secondary badge-pill">Nível 10</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Personagem 2
                    <span class="badge text-bg-secondary badge-pill">Nível 20</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Personagem 3
                    <span class="badge text-bg-secondary badge-pill">Nível 15</span>
                </li>
            </ul>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Detalhes do Personagem</h4>
                    <a href="{{ route('criarpersonagem') }}" class="btn btn-primary text-end">Criar personagem?</a>
                </div>
                <div class="card-body">
                    <h2 class="accordion-header" id="headingHP">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHP" aria-expanded="true" aria-controls="collapseHP">
                            Personagem
                        </button>
                    </h2>
                    <div id="collapseHP" class="accordion-collapse collapse show" aria-labelledby="headingHP" data-bs-parent="#rulesAccordion">
                        <div class="accordion-body">
                            <hr>
                            <p><strong>Nome:</strong> Personagem 1</p>
                            <p><strong>Nível:</strong> 10</p>
                            <p><strong>Classe:</strong> Guerreiro</p>
                            <p><strong>Habilidades:</strong> Força, Agilidade</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
