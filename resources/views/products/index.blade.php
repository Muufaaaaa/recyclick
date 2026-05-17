<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h1 class="fw-bold mb-1">
                        Katalog Produk
                    </h1>

                    <p class="text-muted mb-0">
                        Temukan produk reusable, recycled, dan zero waste terbaik.
                    </p>
                </div>

                <a href="{{ route('home') }}" class="btn btn-outline-success rounded-pill mt-3 mt-md-0">
                    ← Kembali ke Home
                </a>
            </div>

            {{-- SEARCH BAR --}}
            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control rounded-start-pill"
                        placeholder="Cari produk eco-friendly..." value="{{ request('search') }}">

                    <button class="btn btn-success rounded-end-pill px-4" type="submit">
                        Cari
                    </button>
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

            {{-- FILTER CATEGORY --}}
            <div class="mb-4 d-flex flex-wrap gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('products.category', $category->slug) }}"
                        class="btn btn-outline-success btn-sm rounded-pill">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            {{-- PRODUCT GRID --}}
            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            {{-- IMAGE --}}
                            <div class="bg-light rounded-top-4 d-flex align-items-center justify-content-center"
                                style="height: 250px; overflow: hidden;">

                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                        style="height: 250px; width: 100%; object-fit: cover;">
                                @else
                                    <span class="text-muted">
                                        No Image
                                    </span>
                                @endif
                            </div>

                            {{-- BODY --}}
                            <div class="card-body d-flex flex-column">

                                @if ($product->eco_badge)
                                    <div class="mb-2">
                                        <span class="badge bg-success">
                                            {{ $product->eco_badge }}
                                        </span>
                                    </div>
                                @endif

                                <h5 class="fw-bold">
                                    {{ $product->name }}
                                </h5>

                                <small class="text-muted">
                                    {{ $product->category->name }}
                                </small>

                                <div class="mt-3">
                                    <h5 class="text-success fw-bold mb-1">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </h5>

                                    <small class="text-muted">
                                        +{{ $product->eco_points_reward }} Eco Points
                                    </small>
                                </div>

                                @auth
                                    <form action="{{ route('wishlist.toggle', $product->slug) }}" method="POST" class="mb-2">
                                        @csrf

                                        @if (in_array($product->id, $wishlistProductIds))
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

                                <div class="mt-auto pt-3">
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="btn btn-success w-100 rounded-pill">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center py-5">
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