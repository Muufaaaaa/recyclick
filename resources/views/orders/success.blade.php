<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 mx-auto" style="max-width: 650px;">
                <div class="card-body text-center py-5">
                    <h1 class="fw-bold text-success">Pesanan Berhasil!</h1>
                    <p class="text-muted mt-3">
                        Terima kasih sudah berbelanja produk ramah lingkungan di Recyclick.
                    </p>

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
                        <p class="mb-0">
                            <strong>Status:</strong> {{ ucfirst($order->status) }}
                        </p>
                    </div>

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
</x-app-layout>