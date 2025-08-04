@extends('layouts.app')
@section('title', 'Postagem de ' . $post->user->name . ' - TellOver')
@section('content')
{{-- Dá pra usar o partials.post_card e aprimorar --}}
<div class="container-fluid">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row">
        <!-- Sidebar Esquerda -->
        <div class="col-md-3 d-none d-md-block">
            @include('partials.sidebar')
        </div>

        <!-- Conteúdo Central (Feed + Stories + Modal) -->
        <div class="col-md-6">
            @include('partials.post_modal')
            @include('partials.post_card', ['post' => $post])
            @include('partials.comments', ['post' => $post])
        </div>

        <!-- Lateral Direita (Sugestões + Chat) -->
        <div class="col-md-3 d-none d-md-block">
            @auth
                @include('partials.suggestions')
                @include('partials.chat_button')
            @endauth
            @guest
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-3 text-center">Atras de funções?</h5>
                        <p>Seja bem-vindo ao <strong>TellOver</strong>!</p>
                        <p>Seja um usuario comum que quer apenas apreciar as artes de outros, ou seja um criador de conteudo!</p>
                        <p class="mt-2">Curioso para saber mais sobre o TellOver?</p>
                        <a href="{{ route('about') }}" class="btn btn-outline-primary">Confira o Sobre</a>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection
