@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Card com Informações do Usuário -->
        <div class="col-md-8 offset-md-2">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Informações do Usuário</h4>
                </div>
                <div class="card-body">
                    <!-- Exibindo Informações do Usuário -->
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nome:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Data de Criação:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $user->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('account.settings') }}" class="btn btn-primary">Editar Perfil</a>
                </div>
            </div>

            <!-- Card com Posts do Usuário -->
            <div class="card">
                <div class="card-header">
                    <h4>Posts de {{ $user->name }}:</h4>
                </div>
                <div class="card-body">
                    <!-- Lista de Posts -->
                    @if($posts->isEmpty())
                        <p>Nenhum post encontrado.</p>
                    @else
                        <ul class="list-group">
                            @foreach($posts as $post)
                                <li class="list-group-item">
                                    <h5>{{ $post->title }}</h5>
                                    <p>{{ $post->body }}</p>
                                    <small>Publicado em {{ $post->created_at->format('d M Y') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card-footer text-end">
                    <!-- Opcional: botão para adicionar novo post -->
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Adicionar Novo Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
