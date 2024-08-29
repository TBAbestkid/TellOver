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

                    {{ __('You are logged in!') }}
                    <hr>
                    
                    <!-- Incluir o botão de criação de posts -->
                    @include('partials.button_post')

                    <!-- Exibir os posts -->
                    <div class="mt-4">
                        <h3>{{ __('Posts') }}</h3>
                        @forelse ($posts as $post)
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ $post->title }}
                                    @if (Auth::check() && Auth::id() === $post->user_id)
                                        <!-- Edição e delete  -->
                                        <div class="float-end">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <!-- Incluindo o botão de deletar modal -->
                                            <!-- @include('partials.button_delete') -->
                                        </div>
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
</div>
<script>
    window.translations = @json([
        'post_deleted' => __('Post deleted successfully.'),
        'confirm_delete' => __('Are you sure you want to delete this post?'),
        // Adicione outras traduções necessárias
    ]);
</script>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
