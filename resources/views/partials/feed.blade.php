<div class="card">
    <div class="card-body" id="postFeed">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @forelse ($posts as $post)
            @include('partials.post_card', ['post' => $post])
            <hr>
        @empty
            <p>{{ __('Não há posts.') }}</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
                {{ __('Crie um post') }}
            </button>
        @endforelse
    </div>
</div>
