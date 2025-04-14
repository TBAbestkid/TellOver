@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="mb-4">Editar Personagem</h1>

    <div class="container mt-5">
        <form action="{{ route('personagem.update', $personagem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card shadow-sm">
                <div class="row g-0">
                    <!-- Coluna para Imagem -->
                    <div class="col-md-4 d-flex justify-content-center align-items-center bg-light">
                        <!-- Imagem do personagem -->
                        <img id="imagem-preview"
                             src="{{ $personagem->imagem ? asset($personagem->imagem) : '' }}"
                             class="img-fluid rounded-start"
                             alt="Imagem do Personagem"
                             style="display: {{ $personagem->imagem ? 'block' : 'none' }};">

                        <!-- Ícone padrão se a imagem não existir -->
                        <i id="icone-padrao" class="fas fa-user fa-10x text-muted" style="display: {{ $personagem->imagem ? 'none' : 'block' }};"></i>
                    </div>
                    <!-- Coluna para o Card de Informações Básicas -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <!-- Nome do Personagem com ícone -->
                                <h4 class="card-title d-flex align-items-center">
                                    <i class="fas fa-user me-2"></i> <!-- Ícone de personagem -->
                                    {{ $personagem->nome }}
                                </h4>

                                <!-- Botão de submit -->
                                <button type="submit" class="btn btn-outline-primary">Salvar Alterações</button>
                            </div>

                            <!-- Informações Genéricas -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5><i class="fas fa-id-card me-2"></i>Informações Básicas</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Nome -->
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $personagem->nome }}" required>
                                                <label for="nome"><i class="fas fa-user me-2"></i>Nome</label>
                                                @error('nome')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Idade -->
                                        <div class="col-md-3 mb-3">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="idade" name="idade" placeholder="Idade" value="{{ $personagem->idade }}">
                                                <label for="idade"><i class="fas fa-calendar-alt me-2"></i>Idade</label>
                                                @error('idade')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Altura -->
                                        <div class="col-md-3 mb-3">
                                            <div class="form-floating">
                                                <input type="number" step="0.01" class="form-control" id="altura" name="altura" placeholder="Altura" value="{{ $personagem->altura }}">
                                                <label for="altura"><i class="fas fa-arrows-alt-v me-2"></i>Altura (em metros)</label>
                                                @error('altura')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Raça -->
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="tipo_monstro" name="tipo_monstro" placeholder="Raça" value="{{ $personagem->tipo_monstro }}">
                                                <label for="tipo_monstro"><i class="fas fa-dragon me-2"></i>Raça</label>
                                                @error('tipo_monstro')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Imagem -->
                                        <!-- Input para upload -->
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input type="file"
                                                    class="form-control @error('imagem') is-invalid @enderror"
                                                    id="imagem"
                                                    name="imagem"
                                                    accept="image/*">
                                                <label for="imagem"><i class="fas fa-image me-2"></i>Imagem de Personagem</label>
                                                @error('imagem')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card do Personagem -->
            <div class="mt-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3><i class="fas fa-user"></i> Nível: {{ $nivel->nivel }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span><i class="fas fa-heart"></i> HP: {{ $personagem->hp }}</span>
                        </div>

                        <!-- Barra de progresso do XP -->
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ ($nivel->xp_atual / $nivel->xp_necessario) * 100 }}%"
                                 aria-valuenow="{{ $nivel->xp_atual }}" aria-valuemin="0" aria-valuemax="{{ $nivel->xp_necessario }}">
                                <span><i class="fas fa-bolt"></i> XP: {{ $nivel->xp_atual }} / {{ $nivel->xp_necessario }}</span>
                            </div>
                        </div>
                        <br>
                        <!-- Detalhes do Personagem -->
                        <h5 class="mb-3"><i class="fas fa-cogs"></i> Atributos</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fas fa-dumbbell"></i> Força: {{ $personagem->forca }}x</li>
                            <li class="list-group-item"><i class="fas fa-running"></i> Velocidade: {{ $personagem->velocidade }}x</li>
                            <li class="list-group-item"><i class="fas fa-bullseye"></i> Precisão: {{ $personagem->mira }}x</li>
                            <li class="list-group-item"><i class="fas fa-shield-alt"></i> Armadura: {{ $personagem->armadura_atributo ?? 0 }}x</li>
                            <li class="list-group-item"><i class="fas fa-user-shield"></i> Resistencia: {{ $personagem->resistencia_atributo ?? 0 }}x</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Outras Seções em Cards -->
            <div class="mt-4">
                <!-- Personalidade e Informações de Origem -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-user-tag me-2"></i>Personalidade e Informações de Origem</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Personalidade -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="personalidade" name="personalidade" placeholder="Personalidade" value="{{ $personagem->personalidade }}">
                                    <label for="personalidade"><i class="fas fa-user-ninja me-2"></i>Personalidade</label>
                                    @error('personalidade')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Gênero -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="genero" name="genero" placeholder="Gênero" value="{{ $personagem->genero }}">
                                    <label for="genero"><i class="fas fa-genderless me-2"></i>Gênero</label>
                                    @error('genero')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Sexualidade -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sexualidade" name="sexualidade" placeholder="Sexualidade" value="{{ $personagem->sexualidade }}">
                                    <label for="sexualidade"><i class="fas fa-heart me-2"></i>Sexualidade</label>
                                </div>
                            </div>
                            <!-- Origem -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="origem" name="origem" placeholder="Origem" value="{{ $personagem->origem }}">
                                    <label for="origem"><i class="fas fa-map-marker-alt me-2"></i>Origem</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preferências e História -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-thumbs-up me-2"></i>Preferências</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Gosta -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="gosta" name="gosta" placeholder="Gosta" value="{{ $personagem->gosta }}">
                                    <label for="gosta"><i class="fas fa-heart me-2"></i>Gosta</label>
                                    @error('gosta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Não gosta -->
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nao_gosta" name="nao_gosta" placeholder="Não gosta" value="{{ $personagem->nao_gosta }}">
                                    <label for="nao_gosta"><i class="fas fa-heart-broken me-2"></i>Não gosta</label>
                                    @error('nao_gosta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" id="historia" name="historia" placeholder="História" style="height: 100px">{{ $personagem->historia }}</textarea>
                                <label for="historia"><i class="fas fa-book-open me-2"></i>História</label>
                                @error('historia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Habilidades -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-magic me-2"></i>Habilidades</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $habilidades = json_decode($personagem->habilidades, true);
                                $habilidadesAtivas = array_filter($habilidades, fn($valor) => $valor === 1);
                                $habilidadesIcons = [
                                    'forca' => ['icon' => 'fa-hand-rock', 'color' => 'alert-danger', 'label' => 'Força'],
                                    'velocidade' => ['icon' => 'fa-tachometer-alt', 'color' => 'alert-success', 'label' => 'Velocidade'],
                                    'precisao' => ['icon' => 'fa-bullseye', 'color' => 'alert-primary', 'label' => 'Precisão'],
                                    'vida' => ['icon' => 'fa-heart', 'color' => 'alert-warning', 'label' => 'Vida'],
                                    'multi_ataque' => ['icon' => 'fa-sync-alt', 'color' => 'alert-info', 'label' => 'Multi Ataque'],
                                    'regeneracao' => ['icon' => 'fa-seedling', 'color' => 'alert-secondary', 'label' => 'Regeneração'],
                                    'cura' => ['icon' => 'fa-pills', 'color' => 'alert-dark', 'label' => 'Cura'],
                                    'vampirismo' => ['icon' => 'fa-syringe', 'color' => 'alert-danger', 'label' => 'Vampirismo'],
                                    'teleporte_global' => ['icon' => 'fa-rocket', 'color' => 'alert-info', 'label' => 'Teleporte Global'],
                                    'teleporte_curto' => ['icon' => 'fa-portal', 'color' => 'alert-primary', 'label' => 'Teleporte Curto'],
                                    'armadura_fisica' => ['icon' => 'fa-shield-alt', 'color' => 'alert-dark', 'label' => 'Armadura Física'],
                                    'armadura_magica' => ['icon' => 'fa-magic', 'color' => 'alert-primary', 'label' => 'Armadura Mágica'],
                                    'armadura_elemental' => ['icon' => 'fa-fire-alt', 'color' => 'alert-warning', 'label' => 'Armadura Elemental'],

                                    // Cineses
                                    'pyrocinese' => ['icon' => 'fa-fire', 'color' => 'alert-danger', 'label' => 'Pyrocinese'],
                                    'hidrocinese' => ['icon' => 'fa-tint', 'color' => 'alert-info', 'label' => 'Hidrocinese'],
                                    'criocinese' => ['icon' => 'fa-snowflake', 'color' => 'alert-primary', 'label' => 'Criocinese'],
                                    'geocinese' => ['icon' => 'fa-mountain', 'color' => 'alert-secondary', 'label' => 'Geocinese'],
                                    'metalocinese' => ['icon' => 'fa-cog', 'color' => 'alert-dark', 'label' => 'Metalocinese'],
                                    'fumocinese' => ['icon' => 'fa-smog', 'color' => 'alert-secondary', 'label' => 'Fumocinese'],
                                    'fitocinese' => ['icon' => 'fa-leaf', 'color' => 'alert-success', 'label' => 'Fitocinese'],
                                    'photocinese' => ['icon' => 'fa-sun', 'color' => 'alert-warning', 'label' => 'Photocinese'],
                                    'umbracinese' => ['icon' => 'fa-moon', 'color' => 'alert-dark', 'label' => 'Umbracinese'],
                                    'telecinese' => ['icon' => 'fa-brain', 'color' => 'alert-info', 'label' => 'Telecinese'],
                                    'aerocinese' => ['icon' => 'fa-wind', 'color' => 'alert-secondary', 'label' => 'Aerocinese'],
                                    'eletrocinese' => ['icon' => 'fa-bolt', 'color' => 'alert-warning', 'label' => 'Eletrocinese'],
                                    'hemocinese' => ['icon' => 'fa-dna', 'color' => 'alert-danger', 'label' => 'Hemocinese'],
                                    'acidumcinese' => ['icon' => 'fa-flask', 'color' => 'alert-success', 'label' => 'Acidumcinese'],
                                    'venocinese' => ['icon' => 'fa-spider', 'color' => 'alert-dark', 'label' => 'Venocinese'],
                                    'aethercinese' => ['icon' => 'fa-star', 'color' => 'alert-primary', 'label' => 'Aethercinese'],
                                ];
                            @endphp

                            @if(count($habilidadesAtivas) > 0)
                                @foreach($habilidadesAtivas as $habilidade => $valor)
                                    @if(array_key_exists($habilidade, $habilidadesIcons))
                                        <div class="col-md-4 mb-3">
                                            <div class="alert {{ $habilidadesIcons[$habilidade]['color'] }} d-flex align-items-center">
                                                <i class="fas {{ $habilidadesIcons[$habilidade]['icon'] }} me-2"></i>
                                                <strong>{{ $habilidadesIcons[$habilidade]['label'] }}</strong>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p class="text-center">Este personagem não possui habilidades ativadas.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
