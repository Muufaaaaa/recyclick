<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <a href="{{ route('products.index') }}" class="recy-btn-outline text-decoration-none d-inline-block mb-4">
                ← Kembali ke Katalog
            </a>

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

            <div class="row g-5 align-items-start">

                {{-- IMAGE SIDE --}}
                <div class="col-lg-6">
                    <div class="recy-detail-image-wrap">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="recy-detail-image">
                        @else
                            <div class="recy-detail-image d-flex align-items-center justify-content-center text-muted">
                                No Image
                            </div>
                        @endif
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-4">
                            <div class="recy-mini-info text-center">
                                <small class="text-muted d-block">Kategori</small>
                                <strong>{{ $product->category->name }}</strong>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="recy-mini-info text-center">
                                <small class="text-muted d-block">Eco Points</small>
                                <strong class="text-success">+{{ $product->eco_points_reward }}</strong>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="recy-mini-info text-center">
                                <small class="text-muted d-block">Stok</small>
                                <strong>{{ $product->stock }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DETAIL SIDE --}}
                <div class="col-lg-6">
                    <div class="recy-detail-panel">

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if ($product->eco_badge)
                                <span class="recy-badge">
                                    {{ $product->eco_badge }}
                                </span>
                            @endif

                            @auth
                                @if ($isWishlisted)
                                    <span class="badge bg-danger rounded-pill">
                                        ♥ Sudah di Wishlist
                                    </span>
                                @endif
                            @endauth
                        </div>

                        <h1 class="fw-bold mb-2">
                            {{ $product->name }}
                        </h1>

                        <p class="text-muted mb-4">
                            {{ $product->category->name }} · Produk ramah lingkungan pilihan Recyclick
                        </p>

                        <h2 class="recy-price mb-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h2>

                        @if ($product->stock <= 5 && $product->stock > 0)
                            <div class="recy-stock-warning mb-4">
                                Hanya tersisa {{ $product->stock }} item
                            </div>
                        @elseif ($product->stock <= 0)
                            <div class="badge bg-secondary rounded-pill mb-4 p-2">
                                Stok Habis
                            </div>
                        @endif

                        <hr>

                        <h5 class="fw-bold mt-4">
                            Deskripsi Produk
                        </h5>

                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <div class="recy-eco-box my-4">
                            <h5 class="fw-bold text-success mb-2">
                                Green Impact
                            </h5>

                            <p class="text-muted mb-2">
                                Dengan membeli produk ini, kamu ikut mendukung gaya hidup berkelanjutan dan mengurangi penggunaan barang sekali pakai.
                            </p>

                            <div class="d-flex justify-content-between">
                                <span>Eco Impact</span>
                                <strong class="text-success">{{ $product->eco_impact }}x kontribusi</strong>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="recy-mini-info">
                                    <small class="text-muted d-block">Pengiriman</small>
                                    <strong>Estimasi 2–4 hari</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="recy-mini-info">
                                    <small class="text-muted d-block">Pembayaran</small>
                                    <strong>COD / E-Wallet / QRIS Dummy</strong>
                                </div>
                            </div>
                        </div>

                        @auth
                            <div class="d-grid gap-2">
                                @if ($product->stock > 0)
                                    <form action="{{ route('cart.store', $product->slug) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="recy-btn-primary w-100">
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary rounded-pill w-100 py-2" disabled>
                                        Stok Habis
                                    </button>
                                @endif

                                <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST">
                                    @csrf

                                    @if ($isWishlisted)
                                        <button type="submit" class="btn btn-danger rounded-pill w-100 py-2">
                                            ♥ Sudah di Wishlist
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-outline-danger rounded-pill w-100 py-2">
                                            ♡ Tambah ke Wishlist
                                        </button>
                                    @endif
                                </form>
                            </div>
                        @endauth

                        @guest
                            <div class="alert alert-success rounded-4 mt-4">
                                Login terlebih dahulu untuk menambahkan produk ke keranjang atau wishlist.
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('login') }}" class="recy-btn-primary text-decoration-none">
                                    Login
                                </a>

                                <a href="{{ route('register') }}" class="recy-btn-outline text-decoration-none">
                                    Register
                                </a>
                            </div>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>