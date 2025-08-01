@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg rounded-4 border-0 w-100" style="max-width: 500px;">
        <div class="card-body p-5">
            <h3 class="mb-4 text-center text-primary">Seja bem-vindo de volta!</h3>
            <!-- Botão Google -->
            <div class="d-grid mb-3">
                <a href="{{ route('google.login') }}" class="btn btn-light border rounded-3 shadow-sm py-2">
                    <i class="fab fa-google"></i> Entrar com Google
                </a>
            </div>

            <div class="text-center text-muted mb-3">
                <small>ou</small>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Campo de email -->
                <div class="form-floating mb-4">
                    <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                    <label for="email"><i class="fas fa-envelope me-2 text-secondary"></i>Email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo de senha -->
                <div class="form-floating mb-4">
                    <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Senha">
                    <label for="password"><i class="fas fa-lock me-2 text-secondary"></i>Senha</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Checkbox lembrar-me -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-light" for="remember">{{ __('Lembrar-me') }}</label>
                </div>

                <!-- Botão de login -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg rounded-3">
                        <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
                    </button>
                </div>

                <!-- Link para recuperar senha -->
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="text-decoration-none text-info" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection
