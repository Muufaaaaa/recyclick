<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Wishlist</h1>
                    <p class="text-muted mb-0">
                        Produk ramah lingkungan yang kamu simpan.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="btn btn-outline-success rounded-pill mt-3 mt-md-0">
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
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="bg-light rounded-top-4 d-flex align-items-center justify-content-center"
                                style="height: 230px; overflow: hidden;">
                                @if ($wishlist->product->image)
                                    <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="img-fluid"
                                        style="height: 230px; width: 100%; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-danger align-self-start">
                                        ♥ Sudah di Wishlist
                                    </span>

                                    @if ($wishlist->product->eco_badge)
                                        <span class="badge bg-success align-self-start">
                                            {{ $wishlist->product->eco_badge }}
                                        </span>
                                    @endif
                                </div>

                                <h5 class="fw-bold">
                                    {{ $wishlist->product->name }}
                                </h5>

                                <small class="text-muted">
                                    {{ $wishlist->product->category->name }}
                                </small>

                                <h5 class="text-success fw-bold mt-3">
                                    Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}
                                </h5>

                                <div class="mt-auto d-grid gap-2">
                                    <a href="{{ route('products.show', $wishlist->product->slug) }}"
                                        class="btn btn-success rounded-pill">
                                        Detail
                                    </a>

                                    <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger rounded-pill w-100">
                                            Hapus Wishlist
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center py-5">
                                <h4 class="fw-bold">Wishlist masih kosong</h4>
                                <p class="text-muted">
                                    Simpan produk favorit kamu untuk dibeli nanti.
                                </p>
                                <a href="{{ route('products.index') }}" class="btn btn-success rounded-pill px-4">
                                    Lihat Produk
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>