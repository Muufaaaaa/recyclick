<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-badge">Saved Products</span>
                    <h1 class="fw-bold mt-3 mb-1">Wishlist</h1>
                    <p class="text-muted mb-0">
                        Produk ramah lingkungan yang kamu simpan untuk dibeli nanti.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="recy-btn-outline text-decoration-none mt-3 mt-md-0">
                    Lanjut Belanja
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                @forelse ($wishlists as $wishlist)
                    <div class="col-md-3">
                        <div class="recy-wishlist-card h-100">
                            <div style="height: 230px; overflow: hidden;">
                                @if ($wishlist->product->image)
                                    <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="recy-wishlist-img"
                                        alt="{{ $wishlist->product->name }}">
                                @else
                                    <div class="recy-wishlist-img d-flex align-items-center justify-content-center text-muted">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="p-3 d-flex flex-column" style="min-height: 260px;">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-danger rounded-pill">
                                        ♥ Sudah di Wishlist
                                    </span>

                                    @if ($wishlist->product->eco_badge)
                                        <span class="recy-badge">
                                            {{ $wishlist->product->eco_badge }}
                                        </span>
                                    @endif
                                </div>

                                <h5 class="fw-bold mb-1">
                                    {{ $wishlist->product->name }}
                                </h5>

                                <small class="text-muted">
                                    {{ $wishlist->product->category->name }}
                                </small>

                                <h5 class="recy-price mt-3">
                                    Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}
                                </h5>

                                <small class="text-muted">
                                    +{{ $wishlist->product->eco_points_reward }} Eco Points
                                </small>

                                <div class="mt-auto d-grid gap-2 pt-3">
                                    <a href="{{ route('products.show', $wishlist->product->slug) }}"
                                        class="recy-btn-primary text-decoration-none text-center">
                                        Detail Produk
                                    </a>

                                    <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger rounded-pill w-100"
                                            onclick="return confirm('Hapus produk ini dari wishlist?')">
                                            Hapus Wishlist
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="recy-empty-state">
                            <div class="recy-animated-icon mx-auto mb-3">
                                <span class="recy-icon-recycle">♡</span>
                            </div>

                            <h4 class="fw-bold">Wishlist masih kosong</h4>

                            <p class="text-muted">
                                Simpan produk favorit kamu agar mudah ditemukan lagi.
                            </p>

                            <a href="{{ route('products.index') }}" class="recy-btn-primary text-decoration-none">
                                Lihat Produk
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>