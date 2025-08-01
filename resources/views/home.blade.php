@extends('layouts.app')

@section('content')
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
            @include('partials.stories')
            @include('partials.post_modal')
            @include('partials.feed')
        </div>

        <!-- Lateral Direita (Sugestões + Chat) -->
        <div class="col-md-3 d-none d-md-block">
            @include('partials.suggestions')
            @include('partials.chat_button')
        </div>
    </div>
</div>
@endsection
