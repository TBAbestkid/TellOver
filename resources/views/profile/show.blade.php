@extends('layouts.app')
@section('title', 'Perfil de ' . $user->name)
@section('content')

@php
    function userAvatar($user, $size = 64) {
        return $user->avatar
            ? asset($user->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . "&size={$size}&background=0D8ABC&color=fff";
    }

    function userHandle($user) {
        return $user->username ? '@' . $user->username : '@user' . $user->id;
    }
@endphp

<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Perfil do Usuário -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <!-- Banner do Usuário -->
                    @if($user->banner)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $user->banner) }}" alt="Banner" class="img-fluid rounded mb-3" style="width: 100%; height: auto; object-fit: cover;">
                        </div>
                    @else
                       <div class="mb-3">
                            <div style="width: 100%; height: 200px; background-color: #6c757d; border-radius: 0.375rem;" class="mb-3"></div>
                        </div>
                    @endif

                    <!-- Botão de Editar Perfil com ícone de Engrenagem -->
                    @if($isOwner)
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('account.settings') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-cogs"></i>
                            </a>
                        </div>
                    @endif

                    <div class="d-flex align-items-center">
                        <!-- Avatar do Usuário -->
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle me-3" width="64" height="64">
                        @else
                            <img src="https://via.placeholder.com/64?text=Avatar" alt="Avatar Padrão" class="rounded-circle me-3" width="64" height="64">
                        @endif

                        <div>
                            <h5 class="mb-0">{{ $user->name }} <small class="text-muted">{{ userHandle($user) }}</small></h5>
                            <small class="text-muted">Entrou em {{ $user->created_at->format('d M Y') }}</small>

                            <div class="mt-2">
                                <strong>Posts: </strong> {{ $user->posts?->count() ?? 0 }}
                                <strong>Seguidores: </strong>{{ $user->followers?->count() ?? 0 }}
                                <strong class="mx-2">Seguindo: </strong>{{ $user->following?->count() ?? 0 }}
                            </div>

                            @if($user->bio)
                                <p class="mt-2">{{ $user->bio }}</p>
                            @endif

                            @if($user->website)
                                <p><strong>Website: </strong>
                                    <a href="{{ $user->website }}" target="_blank" class="text-decoration-none">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </p>
                            @endif

                            @if($user->location)
                                <p><strong>Localização: </strong>{{ $user->location }}</p>
                            @endif

                            @if($user->birthday)
                                <p><strong>Aniversário: </strong>{{ \Carbon\Carbon::parse($user->birthday)->format('d M Y') }}</p>
                            @endif

                            @if($user->last_active_at)
                                <p><strong>Última Atividade: </strong>{{ $user->last_active_at->format('d M Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Posts -->
            @if($posts->isEmpty())
                <div class="alert alert-info">Nenhum post encontrado.</div>
            @else
                @foreach($posts as $post)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img src="{{ userAvatar($post->user, 64) }}" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <strong>{{ $post->user->name }}</strong>
                                        <span class="text-muted">{{ userHandle($post->user) }}</span>
                                    </div>
                                </div>

                                @if($isOwner && Auth::id() === $post->user_id)
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}"><i class="bi bi-pencil"></i> Editar</a></li>
                                            <li>
                                                @include('partials.button_delete', ['post' => $post])
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <h5 class="mt-3">{{ $post->title }}</h5>
                            <p>{{ $post->body }}</p>

                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid rounded my-2" alt="Imagem do post">
                            @endif

                            <div class="d-flex justify-content-around mt-3 text-muted">
                                <span><i class="bi bi-heart"></i> {{ $post->likes_count ?? 0 }}</span>
                                <span><i class="bi bi-chat"></i> {{ $post->comments_count ?? 0 }}</span>
                                <span><i class="bi bi-share"></i></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($isOwner)
                <div class="text-end">
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">Adicionar Novo Post</a>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
