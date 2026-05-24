<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-badge">Eco Products</span>

                    <h1 class="fw-bold mt-3 mb-1">
                        Katalog Produk
                    </h1>

                    <p class="text-muted mb-0">
                        Temukan produk reusable, recycled, dan zero waste terbaik dari Recyclick.
                    </p>
                </div>

                <a href="{{ route('home') }}" class="recy-btn-outline text-decoration-none mt-3 mt-md-0">
                    ← Kembali ke Home
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

            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control recy-search"
                            placeholder="Cari produk ramah lingkungan..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="recy-btn-primary" type="submit">
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            @if (request('search'))
                <div class="alert alert-success rounded-4">
                    Hasil pencarian untuk:
                    <strong>{{ request('search') }}</strong>

                    <a href="{{ route('products.index') }}" class="float-end text-success fw-bold">
                        Reset
                    </a>
                </div>
            @endif

            <div class="mb-4 d-flex flex-wrap gap-2">
                <a href="{{ route('products.index') }}" class="recy-filter-pill">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('products.category', $category->slug) }}" class="recy-filter-pill">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-md-3">
                        <div class="recy-card h-100 d-flex flex-column">

                            <div style="height: 250px; overflow: hidden; background: #f8fafc;">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="recy-product-image">
                                @else
                                    <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="recy-product-body">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    @if ($product->eco_badge)
                                        <span class="recy-badge">
                                            {{ $product->eco_badge }}
                                        </span>
                                    @endif

                                    @auth
                                        @if (in_array($product->id, $wishlistProductIds ?? []))
                                            <span class="badge bg-danger rounded-pill">
                                                ♥ Wishlist
                                            </span>
                                        @endif
                                    @endauth
                                </div>

                                <h5 class="fw-bold mb-1">
                                    {{ $product->name }}
                                </h5>

                                <small class="text-muted">
                                    {{ $product->category->name }}
                                </small>

                                <div class="mt-3">
                                    <h5 class="recy-price mb-1">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </h5>

                                    <small class="text-muted">
                                        +{{ $product->eco_points_reward }} Eco Points
                                    </small>
                                </div>

                                <div class="mt-auto pt-3">
                                    @auth
                                        <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST"
                                            class="mb-2">
                                            @csrf

                                            @if (in_array($product->id, $wishlistProductIds ?? []))
                                                <button type="submit" class="btn btn-danger w-100 rounded-pill">
                                                    ♥ Sudah di Wishlist
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                                                    ♡ Wishlist
                                                </button>
                                            @endif
                                        </form>
                                    @endauth

                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="recy-btn-primary text-decoration-none w-100 d-block text-center">
                                        Detail Produk
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="recy-card">
                            <div class="p-5 text-center">
                                <h4 class="fw-bold">
                                    Produk belum tersedia
                                </h4>

                                <p class="text-muted mb-0">
                                    Produk eco-friendly akan segera hadir.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>