@extends('layouts.app')
@section('title', 'Postagem de ' . $post->user->name)
@section('content')
{{-- Dá pra usar o partials.post_card e aprimorar --}}
<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('partials.post_card', ['post' => $post])
        </div>
    </div>
</div>
@endsection
