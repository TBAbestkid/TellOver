<div class="comments mt-3">
    <h5>Comentários ({{ $post->comments->count() }})</h5>

    @auth
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-2">
                <textarea name="content" class="form-control" rows="2" placeholder="Deixe um comentário..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
        </form>
    @endauth

    <div class="mt-3">
        @forelse($post->comments as $comment)
            <div class="border rounded p-2 mb-2">
                <strong>{{ $comment->user->name }}</strong>
                <div class="text-muted small">{{ $comment->created_at->diffForHumans() }}</div>
                <p class="mb-0">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-muted">Nenhum comentário ainda.</p>
        @endforelse
    </div>
</div>
