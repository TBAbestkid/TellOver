@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Adicionar Monstro/NPC</h2>
    <hr>

    <!-- Formulário para criar um monstro/NPC -->
    <form action="{{ route('bestiario.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Card de Informações Gerais -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informações Gerais</h5>
            </div>
            <div class="card-body">
                <div class="row g-0">
                    <!-- Coluna para a Imagem -->
                    <div class="col-md-4 d-flex justify-content-center align-items-center bg-light mb-4">
                        @if(old('imagem') || isset($personagem) && $personagem->imagem)
                            <!-- Exibe a imagem do personagem, se existir -->
                            <img src="{{ isset($personagem) && $personagem->imagem ? Storage::url($personagem->imagem) : old('imagem') }}" class="img-fluid rounded-start" alt="Imagem da Criatura">
                        @else
                            <!-- Ícone padrão se não houver imagem -->
                            <i class="fas fa-user fa-10x text-muted"></i>
                        @endif
                    </div>

                    <!-- Coluna para Nome, Nível, Tipo e Categoria -->
                    <div class="col-md-8">
                        <div class="mb-4">
                            <!-- Nome do Monstro/NPC -->
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" placeholder="Nome" value="{{ old('nome') }}" required>
                                <label for="nome"><i class="fas fa-user me-2"></i>Nome do Monstro/NPC</label>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Nível -->
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel" placeholder="Nível" value="{{ old('nivel') }}" required>
                                    <label for="nivel"><i class="fas fa-cogs me-2"></i>Nível</label>
                                    @error('nivel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tipo (Monstro ou NPC) -->
                            <div class="col-md-6 mb-4">
                                <div class="form-floating">
                                    <select class="form-select @error('is_npc') is-invalid @enderror" id="is_npc" name="is_npc">
                                        <option value="0" {{ old('is_npc') == 0 ? 'selected' : '' }}>Monstro</option>
                                        <option value="1" {{ old('is_npc') == 1 ? 'selected' : '' }}>NPC</option>
                                    </select>
                                    <label for="is_npc"><i class="fas fa-user-alt me-2"></i>Tipo</label>
                                    @error('is_npc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Categoria (opcional) -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <select class="form-select @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id">
                                    <option value="">Sem Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="categoria_id"><i class="fas fa-th-large me-2"></i>Categoria</label>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campo para Enviar a Imagem -->
                <div class="mb-4">
                    <div class="form-floating">
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/*">
                        <label for="imagem"><i class="fas fa-image me-2"></i>Imagem da Criatura</label>
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Card de Status -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Status</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- HP -->
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" placeholder="HP" value="{{ old('hp', 1) }}">
                            <label for="hp"><i class="fas fa-heart me-2"></i>HP</label>
                            @error('hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Força -->
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('forca') is-invalid @enderror" id="forca" name="forca" placeholder="Força" value="{{ old('forca', 1) }}">
                            <label for="forca"><i class="fas fa-hand-rock me-2"></i>Força</label>
                            @error('forca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Precisão -->
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('precisao') is-invalid @enderror" id="precisao" name="precisao" placeholder="Precisão" value="{{ old('precisao', 1) }}">
                            <label for="precisao"><i class="fas fa-bullseye me-2"></i>Precisão</label>
                            @error('precisao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Velocidade -->
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('velocidade') is-invalid @enderror" id="velocidade" name="velocidade" placeholder="Velocidade" value="{{ old('velocidade', 1) }}">
                            <label for="velocidade"><i class="fas fa-tachometer-alt me-2"></i>Velocidade</label>
                            @error('velocidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Card de Armaduras, Resistências e Determinação -->
         <div class="card mb-4">
            <div class="card-header">
                <h5>Armadura, Resistência e Determinação</h5>
            </div>
            <div class="card-body">
                <!-- Escolha de Armadura (Global ou Específica) -->
                <div class="mb-4">
                    <div class="form-floating">
                        <select class="form-select @error('tipo_armadura') is-invalid @enderror" id="tipo_armadura" name="tipo_armadura" onchange="toggleArmaduraOptions()">
                            <option value="global" {{ old('tipo_armadura') == 'global' ? 'selected' : '' }}>Armadura Global</option>
                            <option value="especifica" {{ old('tipo_armadura') == 'especifica' ? 'selected' : '' }}>Armaduras Específicas</option>
                        </select>
                        <label for="tipo_armadura"><i class="fas fa-shield-alt me-2"></i>Tipo de Armadura</label>
                        @error('tipo_armadura')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Armadura Global -->
                <div class="mb-4" id="armadura-global-div" style="display: none;">
                    <div class="form-floating">
                        <input type="number" class="form-control @error('armadura_global') is-invalid @enderror" id="armadura_global" name="armadura_global" placeholder="Armadura Global" value="{{ old('armadura_global', 1) }}">
                        <label for="armadura_global"><i class="fas fa-shield-alt me-2"></i>Armadura Global</label>
                        @error('armadura_global')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Armaduras Específicas (Física, Mágica, Elemental) -->
                <div id="armaduras-especificas" style="display: none;">
                    <div class="row">
                        <!-- Armadura Física -->
                        <div class="col-md-4 mb-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('armadura_fisica') is-invalid @enderror" id="armadura_fisica" name="armadura_fisica" placeholder="Armadura Física" value="{{ old('armadura_fisica', 1) }}">
                                <label for="armadura_fisica"><i class="fas fa-shield me-2"></i>Armadura Física</label>
                                @error('armadura_fisica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Armadura Mágica -->
                        <div class="col-md-4 mb-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('armadura_magica') is-invalid @enderror" id="armadura_magica" name="armadura_magica" placeholder="Armadura Mágica" value="{{ old('armadura_magica', 1) }}">
                                <label for="armadura_magica"><i class="fas fa-magic me-2"></i>Armadura Mágica</label>
                                @error('armadura_magica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Armadura Elemental -->
                        <div class="col-md-4 mb-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('armadura_elemental') is-invalid @enderror" id="armadura_elemental" name="armadura_elemental" placeholder="Armadura Elemental" value="{{ old('armadura_elemental', 1) }}">
                                <label for="armadura_elemental"><i class="fas fa-fire-alt me-2"></i>Armadura Elemental</label>
                                @error('armadura_elemental')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resistência -->
                <div class="col-md-4 mb-4">
                    <div class="form-floating">
                        <input type="number" class="form-control @error('resistencia') is-invalid @enderror" id="resistencia" name="resistencia" placeholder="Resistência" value="{{ old('resistencia', 1) }}">
                        <label for="resistencia"><i class="fas fa-shield me-2"></i>Resistência</label>
                        @error('resistencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Determinação -->
                <div class="col-md-4 mb-4">
                    <div class="form-floating">
                        <!-- Toggle Switch -->
                        <div class="form-check form-switch form-check-lg">
                            <input class="form-check-input @error('determinacao') is-invalid @enderror" type="checkbox" id="determinacao" name="determinacao" value="1" {{ old('determinacao') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="determinacao">
                                <i class="fas fa-check-circle me-2"></i>Determinação
                            </label>
                        </div>

                        @error('determinacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão de Submissão -->
        <button type="submit" class="btn btn-success w-100">
            <i class="fas fa-check-circle me-2"></i>Adicionar Monstro/NPC
        </button>
    </form>
</div>

<script>
    // Função para alternar entre Armadura Global e Armaduras Específicas
    function toggleArmaduraOptions() {
        var tipoArmadura = document.getElementById('tipo_armadura').value;
        var armaduraGlobalDiv = document.getElementById('armadura-global-div');
        var armadurasEspecificas = document.getElementById('armaduras-especificas');

        if (tipoArmadura == 'global') {
            armaduraGlobalDiv.style.display = 'block';
            armadurasEspecificas.style.display = 'none';
        } else {
            armaduraGlobalDiv.style.display = 'none';
            armadurasEspecificas.style.display = 'block';
        }
    }

    // Chama a função para definir o estado inicial
    toggleArmaduraOptions();
</script>
@endsection
