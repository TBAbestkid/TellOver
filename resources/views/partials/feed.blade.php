<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-body" id="postFeed">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h3>{{ __('Posts') }}</h3>
        @forelse ($posts as $post)
            @include('partials.post_card', ['post' => $post])
        @empty
            <p>{{ __('Não há posts.') }}</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
                {{ __('Crie um post') }}
            </button>
        @endforelse
    </div>
</div>
