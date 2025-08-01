<!-- resources/views/account/settings.blade.php -->

@extends('layouts.app')
@section('title', 'Configurações da Conta')
@section('content')
<div class="container my-5" style="max-width: 720px;">
    <h2 class="text-center mb-5 fw-bold text-light" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        Configurações da Conta
    </h2>

    <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <!-- Avatar grande no topo com nome e username -->
        <div class="d-flex align-items-center mb-4 gap-3">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle shadow" width="80" height="80" style="object-fit: cover;">
            @else
                <i class="fas fa-user-circle fa-5x text-secondary"></i>
            @endif
            <div>
                <h4 class="mb-0 text-white">{{ Auth::user()->name }}</h4>
                <small class="text-muted">{{ Auth::user()->username ?: strtolower(str_replace(' ', '', Auth::user()->name)) }}</small>
            </div>
        </div>

        <!-- Card para seção: Informações Pessoais -->
        <div class="card text-dark shadow-sm rounded-4 mb-5 p-4 border border-secondary">
            <h5 class="mb-4 fw-semibold border-bottom border-secondary pb-2">Informações Pessoais</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required placeholder="Nome completo">
                    <div class="invalid-feedback">Informe seu nome.</div>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required placeholder="email@exemplo.com">
                    <div class="invalid-feedback">Informe um email válido.</div>
                </div>
            </div>
        </div>

        <!-- Card para Alterar Senha -->
        <div class="card text-dark shadow-sm rounded-4 mb-5 p-4 border border-secondary">
            <h5 class="mb-4 fw-semibold border-bottom border-secondary pb-2">Alterar Senha</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="password" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="current_password" name="current_password" placeholder="Senha atual">
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="new_password" name="new_password" placeholder="Nova senha" aria-describedby="passwordHelpBlock">
                <div id="password-strength-feedback" class="form-text text-danger d-none">Senha fraca</div>
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirmar nova senha">
                </div>
            </div>
        </div>

        <!-- Sobre você -->
        <div class="card shadow-sm rounded-4 mb-5 p-4 border border-secondary">
            <h5 class="mb-4 fw-semibold border-bottom border-secondary pb-2">Sobre Você</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <textarea class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-3" id="bio" name="bio" rows="4" placeholder="Conte algo sobre você...">{{ old('bio', Auth::user()->bio) }}</textarea>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="location" name="location" value="{{ old('location', Auth::user()->location) }}" placeholder="Localização">
                </div>
            </div>
        </div>

        <!-- Contato e Data -->
        <div class="card text-dark shadow-sm rounded-4 mb-5 p-4 border border-secondary">
            <h5 class="mb-4 fw-semibold border-bottom border-secondary pb-2">Contato e Data</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="url" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="website" name="website" value="{{ old('website', Auth::user()->website) }}" placeholder="Website (https://)">
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control form-control-lg bg-transparent border-secondary text-dark rounded-pill" id="birthday" name="birthday" value="{{ old('birthday', Auth::user()->birthday) }}">
                </div>
            </div>
        </div>

        <!-- Imagens -->
        <div class="card text-dark shadow-sm rounded-4 mb-5 p-4 border border-secondary">
            <h5 class="mb-4 fw-semibold border-bottom border-secondary pb-2">Imagens</h5>
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" class="form-control form-control-lg rounded-pill" id="avatar" name="avatar" accept="image/*">
                    @if (Auth::user()->avatar)
                        <div class="mt-3 text-center">
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="img-thumbnail rounded-circle shadow-sm" width="120" height="120" style="object-fit: cover;">
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="banner" class="form-label">Banner</label>
                    <input type="file" class="form-control form-control-lg rounded-pill" id="banner" name="banner" accept="image/*">
                    @if (Auth::user()->banner)
                        <div class="mt-3 text-center">
                        <img src="{{ asset('storage/' . Auth::user()->banner) }}" alt="Banner" class="img-fluid rounded shadow-sm" style="max-height: 120px; object-fit: cover;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Preferências -->
        <div class="card text-dark shadow-sm rounded-4 mb-5 p-4 border border-secondary">
            <h5 class="mb-4 fw-semibold border-bottom border-secondary pb-2">Preferências</h5>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="notifications_email" name="notifications_email" {{ old('notifications_email', Auth::user()->notifications_email) ? 'checked' : '' }}>
                <label class="form-check-label" for="notifications_email">Receber notificações por email</label>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold d-block mb-2">Visibilidade do perfil</label>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="profile_visibility" name="profile_visibility" value="private"
                    {{ old('profile_visibility', Auth::user()->profile_visibility) == 'private' ? 'checked' : '' }}>
                    <label class="form-check-label" for="profile_visibility">
                    {{ old('profile_visibility', Auth::user()->profile_visibility) == 'private' ? 'Privado' : 'Público' }}
                    </label>
                </div>
            </div>
        </div>

        <div class="d-grid mb-5">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>

<script>
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
    // Atualizar texto do label dinamicamente ao mudar o toggle
    const toggle = document.getElementById('profile_visibility');
    const label = toggle.nextElementSibling;

    toggle.addEventListener('change', () => {
        if(toggle.checked) {
            label.textContent = 'Privado';
        } else {
            label.textContent = 'Público';
        }
    });
</script>

@endsection
