<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <h1 class="fw-bold mb-4">Keranjang Belanja</h1>

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
                    <div class="col-md-8">
                        @foreach ($cart->items as $item)
                            @php
                                $subtotal = $item->product->price * $item->quantity;
                                $ecoSubtotal = $item->product->eco_points_reward * $item->quantity;
                                $total += $subtotal;
                                $totalEcoPoints += $ecoSubtotal;
                            @endphp

                            <div class="card border-0 shadow-sm rounded-4 mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
                                                style="height: 90px;">
                                                @if ($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        class="img-fluid rounded-4" style="max-height: 90px;">
                                                @else
                                                    <small class="text-muted">No Image</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="fw-bold mb-1">{{ $item->product->name }}</h5>
                                            <small class="text-muted">
                                                Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                            </small>
                                            <br>
                                            <small class="text-success">
                                                +{{ $item->product->eco_points_reward }} Eco Points/item
                                            </small>
                                        </div>

                                        <div class="col-md-3">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group">
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                        class="form-control">
                                                    <button class="btn btn-outline-success" type="submit">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-md-2">
                                            <p class="fw-bold mb-0">
                                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div class="col-md-1 text-end">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    ×
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <h4 class="fw-bold mb-3">Ringkasan</h4>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Harga</span>
                                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-4">
                                    <span>Eco Points</span>
                                    <strong class="text-success">+{{ $totalEcoPoints }}</strong>
                                </div>

                                <a href="{{ route('checkout') }}" class="btn btn-success w-100 rounded-pill">
                                    Checkout
                                </a>

                                <a href="{{ route('products.index') }}"
                                    class="btn btn-outline-success w-100 rounded-pill mt-2">
                                    Lanjut Belanja
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center py-5">
                        <h4 class="fw-bold">Keranjang masih kosong</h4>
                        <p class="text-muted">Tambahkan produk ramah lingkungan ke keranjang kamu.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-success rounded-pill px-4">
                            Lihat Produk
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>