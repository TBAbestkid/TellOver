@extends('layouts.app')

@section('content')

<!-- -->
<!-- resources/views/partials/button_post.blade.php -->
<button type="button" class="fab-button fab" data-bs-toggle="modal" data-bs-target="#postModal">
    +
</button>

<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Crie um novo post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/posts') }}">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        <label for="title">Título</label>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="4" required>{{ old('body') }}</textarea>
                        <label for="body">Conteúdo</label>
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane"></i> Publicar
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>{{ __('Posts') }}</h3>
                    @forelse ($posts as $post)
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $post->title }}
                                @if (Auth::check() && Auth::user()->id === $post->user_id)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm float-end mx-1">Editar</a>
                                    @include('partials.button_delete', ['post' => $post])
                                @endif
                            </div>
                            <div class="card-body">
                                {{ $post->body }}
                                <footer class="blockquote-footer mt-2">
                                    Postado por {{ $post->user->name }} em {{ $post->created_at->format('d/m/Y H:i') }}
                                </footer>
                            </div>
                        </div>
                    @empty
                        <p>{{ __('Não há posts.') }}</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
                            {{ __('Crie um post') }}
                        </button>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
