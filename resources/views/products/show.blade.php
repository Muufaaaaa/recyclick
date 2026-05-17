<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <a href="{{ route('products.index') }}" class="btn btn-outline-success rounded-pill mb-4">
                ← Kembali
            </a>

            <div class="row g-4">
                <div class="col-md-5">
                    <div class="bg-white shadow-sm rounded-4 p-4 text-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-4">
                        @else
                            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
                                style="height: 350px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="bg-white shadow-sm rounded-4 p-4">
                        @if ($product->eco_badge)
                            <span class="badge bg-success mb-3">{{ $product->eco_badge }}</span>
                        @endif

                        <h1 class="fw-bold">{{ $product->name }}</h1>

                        <p class="text-muted">
                            Kategori: {{ $product->category->name }}
                        </p>

                        <h3 class="text-success fw-bold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h3>

                        <p class="mt-4">
                            {{ $product->description }}
                        </p>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="border rounded-4 p-3">
                                    <small class="text-muted">Stok</small>
                                    <h5 class="mb-0">{{ $product->stock }}</h5>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded-4 p-3">
                                    <small class="text-muted">Eco Point</small>
                                    <h5 class="mb-0">+{{ $product->eco_points_reward }}</h5>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded-4 p-3">
                                    <small class="text-muted">Eco Impact</small>
                                    <h5 class="mb-0">{{ $product->eco_impact }}x</h5>
                                </div>
                            </div>
                        </div>

                        @auth
                            <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST" class="mt-2">
                                @csrf

                                @if ($isWishlisted)
                                    <button type="submit" class="btn btn-danger btn-lg rounded-pill">
                                        ♥ Sudah di Wishlist
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-outline-danger btn-lg rounded-pill">
                                        ♡ Tambah ke Wishlist
                                    </button>
                                @endif
                            </form>
                        @endauth

                        @if ($product->stock > 0)
                            <form action="{{ route('cart.store', $product->slug) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg rounded-pill mt-4">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-lg rounded-pill mt-4" disabled>
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>