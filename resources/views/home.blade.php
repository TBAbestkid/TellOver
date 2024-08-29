@extends('layouts.app')

@section('content')
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
