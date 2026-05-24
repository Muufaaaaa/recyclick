<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-badge">Customer Support</span>
                    <h1 class="fw-bold mt-3 mb-1">Chat Admin</h1>
                    <p class="text-muted mb-0">
                        Tanyakan produk, pesanan, pembayaran, atau bantuan belanja Recyclick.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="recy-btn-outline text-decoration-none mt-3 mt-md-0">
                    Lihat Produk
                </a>
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
                            <h5 class="fw-bold mb-1">Admin Recyclick</h5>
                            <small class="text-muted">
                                Support sederhana untuk pertanyaan produk dan pesanan.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="recy-chat-box" id="chatBox">
                    @forelse ($chats as $chat)
                        @if ($chat->sender === 'user')
                            <div class="d-flex justify-content-end mb-3">
                                <div class="recy-chat-bubble-user">
                                    <div>{{ $chat->message }}</div>
                                    <small class="d-block mt-2 opacity-75">
                                        Kamu • {{ $chat->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-start mb-3">
                                <div class="recy-chat-bubble-admin">
                                    <div>{{ $chat->message }}</div>
                                    <small class="d-block mt-2 text-muted">
                                        Admin Recyclick • {{ $chat->created_at->format('d M Y H:i') }}
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
                                    Mulai percakapan dengan admin Recyclick.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="recy-chat-footer">
                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <input type="text" name="message" class="form-control recy-form-control"
                                placeholder="Tulis pesan..." required>

                            <button type="submit" class="recy-btn-primary">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="alert alert-success rounded-4 mt-4">
                <strong>Catatan:</strong> Fitur chat ini masih versi sederhana. Nanti bisa dikembangkan menjadi realtime
                chat dengan Laravel Reverb/Pusher.
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chatBox');

            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
</x-app-layout>