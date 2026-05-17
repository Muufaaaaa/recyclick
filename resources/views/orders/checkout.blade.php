<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <h1 class="fw-bold mb-4">Checkout</h1>

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

            <div class="row g-4">
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Data Pengiriman</h4>

                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="address" class="form-control rounded-4" rows="4"
                                        required>{{ old('address') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" name="phone" class="form-control rounded-pill"
                                        value="{{ old('phone') }}" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Metode Pembayaran</label>
                                    <select name="payment_method" class="form-select rounded-pill" required>
                                        <option value="COD">COD</option>
                                        <option value="Transfer Bank">Transfer Bank</option>
                                        <option value="E-Wallet">E-Wallet</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    Buat Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Ringkasan Pesanan</h4>

                            @foreach ($cart->items as $item)
                                @php
                                    $subtotal = $item->product->price * $item->quantity;
                                    $ecoSubtotal = $item->product->eco_points_reward * $item->quantity;
                                    $total += $subtotal;
                                    $totalEcoPoints += $ecoSubtotal;
                                @endphp

                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <div>
                                        <strong>{{ $item->product->name }}</strong>
                                        <br>
                                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                                        <br>
                                        <small class="text-success">+{{ $ecoSubtotal }} pts</small>
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between mt-3">
                                <span>Total</span>
                                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mt-2">
                                <span>Eco Points</span>
                                <strong class="text-success">+{{ $totalEcoPoints }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>