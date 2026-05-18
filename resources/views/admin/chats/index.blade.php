<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Chat Pelanggan</h1>
                    <p class="text-muted mb-0">
                        Kelola pesan masuk dari user Recyclick.
                    </p>
                </div>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill mt-3 mt-md-0">
                    Admin Panel
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    @forelse ($conversations as $conversation)
                        @php
                            $unreadCount = \App\Models\Chat::where('user_id', $conversation->user_id)
                                ->where('sender', 'user')
                                ->where('is_read', false)
                                ->count();
                        @endphp

                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <div>
                                <h5 class="fw-bold mb-1">
                                    {{ $conversation->user->name }}
                                </h5>

                                <p class="text-muted mb-1">
                                    {{ Str::limit($conversation->message, 80) }}
                                </p>

                                <small class="text-muted">
                                    Pesan terakhir: {{ $conversation->created_at->format('d M Y H:i') }}
                                </small>
                            </div>

                            <div class="text-end">
                                @if ($unreadCount > 0)
                                    <span class="badge bg-danger rounded-pill mb-2">
                                        {{ $unreadCount }} pesan baru
                                    </span>
                                    <br>
                                @endif

                                <a href="{{ route('admin.chats.show', $conversation->user_id) }}"
                                    class="btn btn-success rounded-pill px-4">
                                    Buka Chat
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <h4 class="fw-bold">Belum ada chat</h4>
                            <p class="text-muted mb-0">
                                Pesan dari user akan muncul di sini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>