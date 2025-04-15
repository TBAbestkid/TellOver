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
                        <div class="card mb-3 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=0D8ABC&color=fff" class="rounded-circle me-2" width="48" height="48" alt="Avatar">
                                        <div>
                                            <strong>{{ $post->user->name }}</strong> <br>
                                            <small class="text-muted">@user{{ $post->user->id }}</small>
                                        </div>
                                    </div>
                                    @if (Auth::check() && Auth::user()->id === $post->user_id)
                                        <div class="dropdown">
                                            <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item text-warning" href="{{ route('posts.edit', $post->id) }}">
                                                        <i class="fas fa-edit me-2"></i> Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    @include('partials.button_delete', ['post' => $post])
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <p class="mt-3 mb-2">{{ $post->body }}</p>

                                {{-- Se tiver imagem no futuro --}}
                                @if (!empty($post->image))
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-2" alt="Imagem do post">
                                @endif

                                <div class="text-muted small mb-2">
                                    Postado em {{ $post->created_at->format('d/m/Y H:i') }}
                                </div>

                                <div class="d-flex justify-content-around mt-2 border-top pt-2">
                                    <button class="btn btn-sm text-muted"><i class="far fa-comment"></i> Comentar</button>
                                    <button class="btn btn-sm text-muted"><i class="far fa-heart"></i> Curtir</button>
                                    <button class="btn btn-sm text-muted"><i class="fas fa-share"></i> Compartilhar</button>
                                </div>
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
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#postModal form');
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route("posts.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                if (response.ok) {
                    const data = await response.json();

                    const newPostHTML = `
                        <div class="card mb-3">
                            <div class="card-header">
                                ${data.post.title}
                                <a href="/posts/${data.post.id}/edit" class="btn btn-warning btn-sm float-end mx-1">Editar</a>
                                <form method="POST" action="/posts/${data.post.id}" style="display:inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger btn-sm float-end">Excluir</button>
                                </form>
                            </div>
                            <div class="card-body">
                                ${data.post.body}
                                <footer class="blockquote-footer mt-2">
                                    Postado por ${data.user} em ${data.created_at}
                                </footer>
                            </div>
                        </div>
                    `;

                    const postContainer = document.querySelector('.card-body > h3').parentElement;
                    postContainer.insertAdjacentHTML('beforeend', newPostHTML);

                    form.reset();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('postModal'));
                    modal.hide();
                } else {
                    const error = await response.json();
                    console.error(error);
                    alert('Erro ao criar o post');
                }
            } catch (err) {
                console.error(err);
                alert('Erro inesperado');
            }
        });
    });
</script>
@endsection
