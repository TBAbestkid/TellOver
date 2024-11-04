@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bestiário</h1>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="monstros-tab" data-bs-toggle="tab" href="#monstros" role="tab" aria-controls="monstros" aria-selected="true">Monstros</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="npcs-tab" data-bs-toggle="tab" href="#npcs" role="tab" aria-controls="npcs" aria-selected="false">NPC</a>
        </li>
    </ul>
<!-- Tab Content -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="monstros" role="tabpanel" aria-labelledby="monstros-tab">
        <h2>Monstros</h2>
        <p>Detalhes sobre os monstros aqui.</p>

        <div class="container">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Nome da Criatura</h5>
                        <div>
                            <button class="btn btn-primary btn-sm me-1" title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm me-1" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-3"><strong>Criador:</strong> Nome do Narrador</div>
                        <div class="me-3"><strong>Nível:</strong> 5</div>
                        <div><strong>Categoria:</strong> Dragão</div>
                    </div>

                    
                    <div>
                        <strong>Atributos Gerais:</strong>
                        <span>HP: 100 | Força: 20 | Precisão: 20 | Velocidade: 30</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="tab-pane fade" id="npcs" role="tabpanel" aria-labelledby="npcs-tab">
        <h2>NPC</h2>
        <p>Detalhes sobre os NPCs aqui.</p>
    </div>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta criatura?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Confirmar Exclusão</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
