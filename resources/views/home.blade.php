<x-app-layout>
    <div class="bg-[#F6F8F3]">

        {{-- HERO --}}
        <section class="py-5">
            <div class="container">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-6">
                        <span class="badge bg-success rounded-pill px-3 py-2 mb-3">
                            EcoCommerce Platform
                        </span>

                        <h1 class="display-4 fw-bold mb-4">
                            Belanja Produk Ramah Lingkungan dengan Recyclick
                        </h1>

                        <p class="lead text-muted mb-4">
                            Dukung gaya hidup berkelanjutan melalui produk reusable,
                            recycled, dan zero waste dengan sistem eco points.
                        </p>

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('products.index') }}" class="btn btn-success btn-lg rounded-pill px-4">
                                Belanja Sekarang
                            </a>

                            @guest
                                <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg rounded-pill px-4">
                                    Gabung Sekarang
                                </a>
                            @endguest
                        </div>
                    </div>

                    <div class="col-lg-6 text-center mt-5 mt-lg-0">
                        <div class="bg-white shadow-lg rounded-5 p-5">
                            <h3 class="fw-bold text-success mb-3">
                                Recyclick Impact
                            </h3>

                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="border rounded-4 p-3">
                                        <h4 class="fw-bold text-success">100+</h4>
                                        <small class="text-muted">Eco Products</small>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded-4 p-3">
                                        <h4 class="fw-bold text-success">250+</h4>
                                        <small class="text-muted">Eco Points</small>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded-4 p-3">
                                        <h4 class="fw-bold text-success">80%</h4>
                                        <small class="text-muted">Reusable</small>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted mt-4 mb-0">
                                Setiap pembelian membantu mengurangi limbah dan mendukung lingkungan yang lebih hijau.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FEATURE --}}
        <section class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Kenapa Recyclick?</h2>
                    <p class="text-muted">
                        Platform eco-commerce sederhana dengan dampak nyata.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4">
                                <h4 class="fw-bold text-success">
                                    Eco Products
                                </h4>

                                <p class="text-muted mb-0">
                                    Produk reusable, recycled, dan zero waste untuk mendukung gaya hidup berkelanjutan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4">
                                <h4 class="fw-bold text-success">
                                    Eco Points
                                </h4>

                                <p class="text-muted mb-0">
                                    Dapatkan poin setiap transaksi ramah lingkungan yang kamu lakukan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4">
                                <h4 class="fw-bold text-success">
                                    Green Impact
                                </h4>

                                <p class="text-muted mb-0">
                                    Setiap pembelian membantu mengurangi penggunaan produk sekali pakai.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FEATURED PRODUCTS --}}
        <section class="py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Produk Unggulan</h2>
                        <p class="text-muted mb-0">
                            Pilihan eco-friendly terbaik dari Recyclick.
                        </p>
                    </div>

                    <a href="{{ route('products.index') }}" class="btn btn-outline-success rounded-pill">
                        Lihat Semua
                    </a>
                </div>

                <div class="row g-4">
                    @foreach ($featuredProducts as $product)
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="bg-light rounded-top-4 d-flex align-items-center justify-content-center"
                                    style="height: 220px;">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-top-4"
                                            style="height: 220px; width: 100%; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </div>

                                <div class="card-body">
                                    @if ($product->eco_badge)
                                        <span class="badge bg-success mb-2">
                                            {{ $product->eco_badge }}
                                        </span>
                                    @endif

                                    <h5 class="fw-bold">
                                        {{ $product->name }}
                                    </h5>

                                    <p class="text-success fw-bold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="btn btn-success w-100 rounded-pill">
                                        Detail Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
</x-app-layout>