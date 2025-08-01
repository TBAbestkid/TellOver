{{-- partials/notifications.blade.php --}}
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        @if(auth()->user()->unreadNotifications->count())
            <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><h6 class="dropdown-header">Notificações</h6></li>
        @forelse(auth()->user()->notifications->take(5) as $notification)
            <li>
                <a class="dropdown-item" href="{{ $notification->data['link'] ?? '#' }}">
                    {{ $notification->data['message'] }}
                    @if(is_null($notification->read_at))
                        <span class="badge bg-warning text-dark">Nova</span>
                    @endif
                </a>
            </li>
        @empty
            <li><span class="dropdown-item">Nenhuma notificação</span></li>
        @endforelse
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-center text-primary" href="{{ route('notifications.index') }}">Ver todas</a></li>
    </ul>
</li>
