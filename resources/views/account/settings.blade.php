<!-- resources/views/account/settings.blade.php -->

@extends('layouts.app')
@section('title', 'Configurações da Conta')
@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Configurações da Conta</h2>

    <!-- Formulário para editar configurações da conta -->
    <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informações Pessoais -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                </div>
            </div>
        </div>

        <!-- Senha -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="current_password" class="form-label">Sua Senha</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Digite sua senha atual">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_password" class="form-label">Nova Senha</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Digite a nova senha">
                    <div id="password-strength-feedback" class="invalid-feedback">Senha fraca</div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_password_confirmation" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirme a nova senha">
                </div>
            </div>
        </div>

        <!-- Bio e Localização -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', Auth::user()->bio) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location" class="form-label">Localização</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', Auth::user()->location) }}">
                </div>
            </div>
        </div>

        <!-- Website e Aniversário -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" class="form-control" id="website" name="website" value="{{ old('website', Auth::user()->website) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birthday" class="form-label">Aniversário</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ old('birthday', Auth::user()->birthday) }}">
                </div>
            </div>
        </div>

        <!-- Avatar -->
        <div class="mb-4">
            <label for="avatar" class="form-label">Avatar</label>
            <div class="input-group">
                <input type="file" class="form-control" id="avatar" name="avatar">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-image"></i></span> <!-- Ícone Font Awesome -->
                </div>
            </div>
            @if (Auth::user()->avatar)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="img-fluid" width="100">
                </div>
            @endif
        </div>

        <!-- Banner -->
        <div class="mb-4">
            <label for="banner" class="form-label">Banner</label>
            <div class="input-group">
                <input type="file" class="form-control" id="banner" name="banner">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-image"></i></span> <!-- Ícone Font Awesome -->
                </div>
            </div>
            @if (Auth::user()->banner)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . Auth::user()->banner) }}" alt="Banner" class="img-fluid" width="100">
                </div>
            @endif
        </div>

        <!-- Preferências de Notificações -->
        <div class="mb-4">
            <label for="notifications_email" class="form-label">Notificações de Email</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifications_email" name="notifications_email" {{ old('notifications_email', Auth::user()->notifications_email) ? 'checked' : '' }}>
                <label class="form-check-label" for="notifications_email">Receber notificações por email</label>
            </div>
        </div>

        <!-- Preferências de Privacidade -->
        <div class="mb-4">
            <label for="profile_visibility" class="form-label">Visibilidade do perfil</label>
            <select class="form-select" id="profile_visibility" name="profile_visibility">
                <option value="public" {{ old('profile_visibility', Auth::user()->profile_visibility) == 'public' ? 'selected' : '' }}>Público</option>
                <option value="private" {{ old('profile_visibility', Auth::user()->profile_visibility) == 'private' ? 'selected' : '' }}>Privado</option>
            </select>
        </div>

        <!-- Botão de Envio -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Salvar Alterações</button>
        </div>
    </form>
</div>
@endsection
