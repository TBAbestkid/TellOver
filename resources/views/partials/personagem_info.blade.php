@if (session('personagem_selecionado'))
    @php
        $personagem = \App\Models\Personagem::find(session('personagem_selecionado'));
        $nivel = \App\Models\Level::where('personagem_id', $personagem->id)->latest()->first();
    @endphp

    @if ($personagem)
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
        <div class="container-fluid p-0 hud-fixo ">
            <div class="row bg-dark text-light py-2 sticky-bottom">
                <!-- Coluna 1: Nome, Nível e Imagem -->
                <div class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center text-center">
                    <!-- Nome e Nível -->
                    <div class="mb-2">
                        <p><strong>Nome:</strong> {{ $personagem->nome }}</p>
                        <p><strong>Nível:</strong> {{ $nivel ? $nivel->nivel : 'N/A' }}</p>
                    </div>
                    <!-- Imagem ou Ícone Padrão -->
                    <div>
                        <img id="imagem-preview"
                            src="{{ $personagem->imagem ? asset($personagem->imagem) : '' }}"
                            class="img-fluid rounded-circle"
                            alt="Imagem do Personagem"
                            style="display: {{ $personagem->imagem ? 'block' : 'none' }}; width: 80px; height: 80px;">
                        <i id="icone-padrao"
                            class="fas fa-user fa-3x text-muted"
                            style="display: {{ $personagem->imagem ? 'none' : 'block' }};"></i>
                    </div>
                </div>

                <!-- Coluna 2: Vida, Habilidades e Status -->
                <div class="col-12 col-md-6">
                    <!-- Barra de Vida -->
                    <div class="barra-progresso mb-3">
                        <label for="hp" class="d-block text-center">Vida</label>
                        <div class="progress" style="height: 20px; background-color: #333;">
                            <div class="progress-bar bg-success"
                                role="progressbar"
                                style="width: {{ ($personagem->hp / $personagem->hp) * 100 }}%; height: 100%;"
                                aria-valuenow="{{ $personagem->hp }}"
                                aria-valuemin="0"
                                aria-valuemax="{{ $personagem->hp }}">
                                {{ $personagem->hp }} / {{ $personagem->hp }} Vida
                            </div>
                        </div>
                    </div>

                    <!-- Habilidades -->
                    <div class="card-body mb-2">
                        <h6 class="text-center">Habilidades</h6>
                        <div class="d-flex flex-wrap justify-content-center">
                            @if(count($habilidadesAtivas) > 0)
                                @foreach($habilidadesAtivas as $habilidade => $valor)
                                    @if(array_key_exists($habilidade, $habilidadesIcons))
                                        <div class="alert {{ $habilidadesIcons[$habilidade]['color'] }} d-flex align-items-center me-2 mb-2 px-2 py-1" style="font-size: 0.85rem;">
                                            <i class="fas {{ $habilidadesIcons[$habilidade]['icon'] }} me-1"></i>
                                            <strong>{{ $habilidadesIcons[$habilidade]['label'] }}</strong>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-center">Sem habilidades ativadas...</p>
                            @endif
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="status">
                        <div class="row">
                            <div class="col-4">
                                <p><strong>Força:</strong> {{ $personagem->forca }}x</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Velocidade:</strong> {{ $personagem->velocidade }}x</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Precisão:</strong> {{ $personagem->mira }}x</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coluna 3: Botões de Ação -->
                <div class="col-12 col-md-3 d-flex flex-column align-items-center">
                    <button class="btn btn-info mb-2 d-flex align-items-center">
                        <i class="fas fa-box me-1"></i>
                    </button>
                    <button class="btn btn-secondary mb-2 d-flex align-items-center">
                        <i class="fas fa-chart-bar me-1"></i>
                    </button>
                    <button class="btn btn-warning mb-2 d-flex align-items-center">
                        <i class="fas fa-cogs me-1"></i>
                    </button>
                </div>
            </div>
        </div>
        <style>
            .hud-fixo {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 1000; /* Garante que o HUD fique acima de outros elementos */
                margin-top: 40px
            }

        </style>
    @endif
@endif
