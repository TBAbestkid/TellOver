@php
    use Illuminate\Support\Str;

    $user = $post->user;
    $username = !empty($user->username) ? $user->username : Str::slug($user->name);
    $url = route('post', ['post' => $post->id, 'username' => $username]);
@endphp

{{-- card clicável --}}
<div class="card mb-3 border-0 rounded-3" style="cursor: pointer;" onclick="window.location.href='{{ $url }}'">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=0D8ABC&color=fff" class="rounded-circle me-2" width="48" height="48" alt="Avatar">
                <div>
                    <a href="{{ route('profile.show', $post->user) }}" class="text-decoration-none"><strong>{{ $post->user->name }}</strong></a>
                    <br>
                    <small class="text-muted">@user{{ $post->user->id }}</small>
                </div>
            </div>
            @if (Auth::check() && Auth::user()->id === $post->user_id)
                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item text-warning" href="{{ route('posts.edit', $post->id) }}">
                                <i class="fas fa-edit me-2"></i> Editar
                            </a>
                        </li>
                        <li>
                            @include('partials.button_delete', ['post' => $post])
                        </li>
                    </ul>
                </div>
            @endif
            <div class="text-muted small mb-2">
                {{ $post->created_at->format('d/m/Y H:i') }}
            </div>
        </div>

        <p class="mt-3 mb-2">{{ $post->body }}</p>

        {{-- Se tiver imagem no futuro --}}
        @php
            $images = json_decode($post->image_path, true);
        @endphp

        @if (!empty($images) && is_array($images))
            <div class="mb-2 d-flex flex-wrap gap-2">
                @foreach ($images as $image)
                    <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" style="max-height: 200px;" alt="Imagem do post">
                @endforeach
            </div>
        @endif

        <div class="d-flex justify-content-around mt-2 border-top pt-2">
            <button class="btn btn-sm text-muted"><i class="far fa-comment"></i> Comentar</button>
            <button class="btn btn-sm text-muted"><i class="far fa-heart"></i> Curtir</button>
            <div class="dropdown">
                <button class="btn btn-sm text-muted dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-share"></i> Compartilhar
                </button>
                <ul class="dropdown-menu">
                    <li>
                    <a class="dropdown-item" target="_blank"
                        href="https://wa.me/?text={{ urlencode($url) }}">
                        WhatsApp
                    </a>
                    </li>
                    <li>
                    <a class="dropdown-item" target="_blank"
                        href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text=Veja+esse+post!">
                        Twitter
                    </a>
                    </li>
                    <li>
                    <a class="dropdown-item" target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}">
                        Facebook
                    </a>
                    </li>
                    <li>
                    <a class="dropdown-item" onclick="copyToClipboard('{{ $url }}')">
                        Copiar Link
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
