<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="recy-success-box mx-auto" style="max-width: 760px;">
                <div class="text-center">
                    <div class="recy-success-icon">
                        ✓
                    </div>

                    <span class="recy-badge">Order Created</span>

                    <h1 class="fw-bold mt-3">
                        Pesanan Berhasil Dibuat!
                    </h1>

                    <p class="text-muted">
                        Terima kasih sudah berbelanja produk ramah lingkungan di Recyclick.
                    </p>
                </div>

                <div class="recy-eco-box my-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Kode Pesanan</small>
                            <strong>{{ $order->order_code }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Total Pembayaran</small>
                            <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Metode Pembayaran</small>
                            <strong>{{ $order->payment_method }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Kode Pembayaran</small>
                            <strong>{{ $order->payment_code }}</strong>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Status Pesanan</small>

                            @if ($order->status === 'pending')
                                <span class="recy-status-badge recy-status-unpaid">Pending</span>
                            @elseif ($order->status === 'processing')
                                <span class="recy-status-badge recy-status-processing">Processing</span>
                            @elseif ($order->status === 'completed')
                                <span class="recy-status-badge recy-status-paid">Completed</span>
                            @else
                                <span class="recy-status-badge recy-status-cancelled">Cancelled</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted d-block">Status Pembayaran</small>

                            @if ($order->payment_status === 'paid')
                                <span class="recy-status-badge recy-status-paid">Paid</span>
                            @else
                                <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <small class="text-muted d-block">Eco Points Didapat</small>
                            <strong class="text-success">+{{ $order->total_eco_points }} Eco Points</strong>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    @if ($order->payment_status !== 'paid')
                        <form action="{{ route('orders.pay', $order->order_code) }}" method="POST" class="mb-3">
                            @csrf

                            <button class="recy-btn-primary">
                                Simulasikan Pembayaran
                            </button>
                        </form>
                    @endif

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('orders.history') }}" class="recy-btn-outline text-decoration-none">
                            Lihat Riwayat
                        </a>

                        <a href="{{ route('products.index') }}" class="recy-btn-outline text-decoration-none">
                            Belanja Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>