@extends('layouts.app')

@section('title', 'TellOver - Notificações')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar esquerda -->
        <div class="col-md-3 d-none d-md-block">
            @include('partials.sidebar')
        </div>

        <!-- Notificações -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Notificações</h5>
                    <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-link">Marcar todas como lidas</button>
                    </form>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($notifications as $notification)
                        <a href="{{ $notification->data['url'] ?? '#' }}"
                           class="list-group-item list-group-item-action {{ $notification->read_at ? 'text-muted' : 'fw-bold' }}">
                            {{ $notification->data['message'] ?? 'Notificação sem conteúdo.' }}
                            <small class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </a>
                    @empty
                        <div class="list-group-item text-center">
                            Nenhuma notificação.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Lateral direita -->
        <div class="col-md-3 d-none d-md-block">
            @include('partials.suggestions')
            @include('partials.chat_button')
        </div>
    </div>
</div>
@endsection
