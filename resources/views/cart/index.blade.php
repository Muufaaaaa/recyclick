<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-badge">Shopping Cart</span>
                    <h1 class="fw-bold mt-3 mb-1">Keranjang Belanja</h1>
                    <p class="text-muted mb-0">
                        Review produk ramah lingkungan sebelum checkout.
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

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @php
                $total = 0;
                $totalEcoPoints = 0;
            @endphp

            @if ($cart->items->count() > 0)
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="d-flex flex-column gap-3">
                            @foreach ($cart->items as $item)
                                @php
                                    $subtotal = $item->product->price * $item->quantity;
                                    $ecoSubtotal = $item->product->eco_points_reward * $item->quantity;
                                    $total += $subtotal;
                                    $totalEcoPoints += $ecoSubtotal;
                                @endphp

                                <div class="recy-cart-item">
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-2 col-4">
                                            @if ($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     class="recy-cart-img"
                                                     alt="{{ $item->product->name }}">
                                            @else
                                                <div class="recy-cart-img d-flex align-items-center justify-content-center text-muted small">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-4 col-8">
                                            <h5 class="fw-bold mb-1">
                                                {{ $item->product->name }}
                                            </h5>

                                            <small class="text-muted d-block">
                                                {{ $item->product->category->name ?? 'Eco Product' }}
                                            </small>

                                            @if ($item->product->eco_badge)
                                                <span class="badge bg-success rounded-pill mt-2">
                                                    {{ $item->product->eco_badge }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <label class="form-label small text-muted mb-1">
                                                    Quantity
                                                </label>

                                                <div class="input-group">
                                                    <input type="number"
                                                           name="quantity"
                                                           value="{{ $item->quantity }}"
                                                           min="1"
                                                           max="{{ $item->product->stock }}"
                                                           class="form-control recy-form-control">

                                                    <button class="btn btn-outline-success rounded-end-pill" type="submit">
                                                        Update
                                                    </button>
                                                </div>

                                                <small class="text-muted">
                                                    Stok: {{ $item->product->stock }}
                                                </small>
                                            </form>
                                        </div>

                                        <div class="col-md-2">
                                            <small class="text-muted d-block">
                                                Subtotal
                                            </small>

                                            <strong class="text-success">
                                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </strong>

                                            <small class="text-muted d-block">
                                                +{{ $ecoSubtotal }} Eco Points
                                            </small>
                                        </div>

                                        <div class="col-md-1 text-md-end">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger rounded-circle"
                                                        onclick="return confirm('Hapus produk ini dari keranjang?')">
                                                    ×
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="recy-summary-card">
                            <span class="recy-badge">Order Summary</span>

                            <h4 class="fw-bold mt-3 mb-4">
                                Ringkasan Belanja
                            </h4>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Produk</span>
                                <strong>{{ $cart->items->sum('quantity') }} item</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Harga</span>
                                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Eco Points</span>
                                <strong class="text-success">+{{ $totalEcoPoints }}</strong>
                            </div>

                            <hr>

                            <div class="recy-eco-box mb-4">
                                <h6 class="fw-bold text-success mb-1">
                                    Green Impact
                                </h6>

                                <small class="text-muted">
                                    Pembelian ini memberi kontribusi sekitar
                                    <strong>{{ $totalEcoPoints * 2 }}x</strong>
                                    dampak hijau.
                                </small>
                            </div>

                            <a href="{{ route('checkout') }}" class="recy-btn-primary text-decoration-none d-block text-center">
                                Checkout Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="recy-empty-state">
                    <div class="recy-animated-icon mx-auto mb-3">
                        <span class="recy-icon-cart">🛒</span>
                    </div>

                    <h4 class="fw-bold">Keranjang masih kosong</h4>

                    <p class="text-muted">
                        Tambahkan produk reusable, recycled, atau zero waste ke keranjang kamu.
                    </p>

                    <a href="{{ route('products.index') }}" class="recy-btn-primary text-decoration-none">
                        Lihat Produk
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>