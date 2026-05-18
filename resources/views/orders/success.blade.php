<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 mx-auto" style="max-width: 650px;">
                <div class="card-body text-center py-5">
                    <h1 class="fw-bold text-success">Pesanan Berhasil!</h1>

                    <p class="text-muted mt-3">
                        Terima kasih sudah berbelanja produk ramah lingkungan di Recyclick.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success rounded-4 mt-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="border rounded-4 p-4 my-4 text-start">
                        <p class="mb-2">
                            <strong>Kode Pesanan:</strong> {{ $order->order_code }}
                        </p>

                        <p class="mb-2">
                            <strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>

                        <p class="mb-2">
                            <strong>Eco Points:</strong>
                            <span class="text-success">+{{ $order->total_eco_points }}</span>
                        </p>

                        <p class="mb-2">
                            <strong>Metode Pembayaran:</strong> {{ $order->payment_method }}
                        </p>

                        <p class="mb-2">
                            <strong>Status Pembayaran:</strong>

                            @if ($order->payment_status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning text-dark">Unpaid</span>
                            @endif
                        </p>

                        <p class="mb-0">
                            <strong>Status Pesanan:</strong> {{ ucfirst($order->status) }}
                        </p>
                    </div>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        @if ($order->payment_status !== 'paid' && $order->payment_method !== 'COD')
                            <a href="{{ route('orders.payment', $order->order_code) }}"
                                class="btn btn-warning rounded-pill px-4">
                                Bayar Sekarang
                            </a>
                        @endif

                        <a href="{{ route('orders.history') }}" class="btn btn-success rounded-pill px-4">
                            Lihat Riwayat Pesanan
                        </a>

                        <a href="{{ route('products.index') }}" class="btn btn-outline-success rounded-pill px-4">
                            Belanja Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>