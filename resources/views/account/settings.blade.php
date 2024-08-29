<!-- resources/views/account/settings.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Account Settings</h2>

    <!-- Formulário para editar configurações da conta -->
    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')

        <!-- Informações Pessoais -->
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <!-- Senha -->
        <div class="mb-3">
            <label for="current_password" class="form-label">Sua senha</label>
            <input type="password" class="form-control" id="current_password" name="current_password">
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Nova senha</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirmar nova senha</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
        </div>

        <!-- Preferências de Notificações -->
        <div class="mb-3">
            <label for="notifications_email" class="form-label">Notificações de Email</label>
            <input type="checkbox" id="notifications_email" name="notifications_email" {{ old('notifications_email', Auth::user()->notifications_email) ? 'checked' : '' }}>
        </div>

        <!-- Preferências de Privacidade -->
        <div class="mb-3">
            <label for="profile_visibility" class="form-label">Visibilidade do perfil</label>
            <select class="form-select" id="profile_visibility" name="profile_visibility">
                <option value="public" {{ old('profile_visibility', Auth::user()->profile_visibility) == 'public' ? 'selected' : '' }}>Public</option>
                <option value="private" {{ old('profile_visibility', Auth::user()->profile_visibility) == 'private' ? 'selected' : '' }}>Private</option>
            </select>
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
