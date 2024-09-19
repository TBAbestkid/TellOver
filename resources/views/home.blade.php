@extends('layouts.app')

@section('content')

<!-- 



-->
<!-- resources/views/partials/button_post.blade.php -->
<button type="button" class="fab-button fab" data-bs-toggle="modal" data-bs-target="#postModal">
    +
</button>

<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Create New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/posts') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">{{ __('Body') }}</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3" required>{{ old('body') }}</textarea>
                        @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Post') }}</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                    <!-- Botão de Editar -->
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm float-end mx-1">
                                        Editar
                                    </a>
                                    <!-- Botão de Deletar -->
                                    @include('partials.button_delete', ['post' => $post])
                                @endif
                            </div>
                            <div class="card-body">
                                {{ $post->body }}
                                <footer class="blockquote-footer mt-2">
                                    Posted by {{ $post->user->name }} on {{ $post->created_at->format('d/m/Y H:i') }}
                                </footer>
                            </div>
                        </div>
                    @empty
                        <p>{{ __('No posts yet.') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
