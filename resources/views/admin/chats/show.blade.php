<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Chat Detail
                        </span>

                        <h1 class="fw-bold mb-2">
                            Chat dengan {{ $user->name }}
                        </h1>

                        <p class="mb-0">
                            Email pelanggan: {{ $user->email }}
                        </p>
                    </div>

                    <a href="{{ route('admin.chats.index') }}" class="btn btn-light rounded-pill fw-bold text-success">
                        ← Kembali
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="recy-chat-shell">
                <div class="recy-chat-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="recy-animated-icon">
                            <span class="recy-icon-chat">💬</span>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ $user->name }}
                            </h5>

                            <small class="text-muted">
                                Percakapan customer support Recyclick.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="recy-chat-box" id="adminChatBox">
                    @forelse ($chats as $chat)
                        @if ($chat->sender === 'admin')
                            <div class="d-flex justify-content-end mb-3">
                                <div class="recy-chat-bubble-user">
                                    <div>{{ $chat->message }}</div>

                                    <small class="d-block mt-2 opacity-75">
                                        Admin Recyclick • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-start mb-3">
                                <div class="recy-chat-bubble-admin">
                                    <div>{{ $chat->message }}</div>

                                    <small class="d-block mt-2 text-muted">
                                        {{ $user->name }} • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-100 d-flex align-items-center justify-content-center text-center">
                            <div>
                                <div class="recy-animated-icon mx-auto mb-3">
                                    <span class="recy-icon-chat">💬</span>
                                </div>

                                <h5 class="fw-bold">Belum ada pesan</h5>

                                <p class="text-muted mb-0">
                                    Percakapan dengan user ini masih kosong.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="recy-chat-footer">
                    <form action="{{ route('admin.chats.reply', $user->id) }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <input type="text" name="message" class="form-control recy-form-control"
                                placeholder="Tulis balasan admin..." required>

                            <button type="submit" class="recy-btn-primary">
                                Balas
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="alert alert-success rounded-4 mt-4">
                <strong>Catatan:</strong> Chat admin ini masih versi non-realtime. Untuk pengembangan lanjutan, fitur
                ini bisa memakai Laravel Reverb/Pusher agar pesan masuk otomatis tanpa refresh.
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('adminChatBox');

            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
</x-app-layout>