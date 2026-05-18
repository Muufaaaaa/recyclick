<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="mb-4">
                <h1 class="fw-bold mb-1">Chat Admin</h1>
                <p class="text-muted mb-0">
                    Kirim pertanyaan seputar produk, pesanan, atau bantuan belanja Recyclick.
                </p>
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

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <div class="chat-box mb-4 p-3 bg-light rounded-4" style="height: 430px; overflow-y: auto;">
                        @forelse ($chats as $chat)
                            @if ($chat->sender === 'user')
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="bg-success text-white rounded-4 p-3" style="max-width: 70%;">
                                        <div>{{ $chat->message }}</div>
                                        <small class="d-block mt-1 opacity-75">
                                            Kamu • {{ $chat->created_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex justify-content-start mb-3">
                                    <div class="bg-white border rounded-4 p-3" style="max-width: 70%;">
                                        <div>{{ $chat->message }}</div>
                                        <small class="d-block mt-1 text-muted">
                                            Admin Recyclick • {{ $chat->created_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="h-100 d-flex align-items-center justify-content-center text-center">
                                <div>
                                    <h5 class="fw-bold">Belum ada pesan</h5>
                                    <p class="text-muted mb-0">
                                        Mulai percakapan dengan admin Recyclick.
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <input type="text" name="message" class="form-control rounded-start-pill"
                                placeholder="Tulis pesan..." required>

                            <button type="submit" class="btn btn-success rounded-end-pill px-4">
                                Kirim
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>