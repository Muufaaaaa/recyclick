<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <span class="recy-badge">Order History</span>
                    <h1 class="fw-bold mt-3 mb-1">Riwayat Pesanan</h1>
                    <p class="text-muted mb-0">
                        Pantau status pesanan dan pembayaran Recyclick kamu.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="recy-btn-outline text-decoration-none mt-3 mt-md-0">
                    Belanja Lagi
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($orders as $order)
                <div class="recy-order-card mb-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ $order->order_code }}
                            </h5>

                            <small class="text-muted">
                                Dibuat pada {{ $order->created_at->format('d M Y H:i') }}
                            </small>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            @if ($order->status === 'pending')
                                <span class="recy-status-badge recy-status-unpaid">Pending</span>
                            @elseif ($order->status === 'processing')
                                <span class="recy-status-badge recy-status-processing">Processing</span>
                            @elseif ($order->status === 'completed')
                                <span class="recy-status-badge recy-status-paid">Completed</span>
                            @else
                                <span class="recy-status-badge recy-status-cancelled">Cancelled</span>
                            @endif

                            @if ($order->payment_status === 'paid')
                                <span class="recy-status-badge recy-status-paid">Paid</span>
                            @elseif ($order->payment_status === 'failed')
                                <span class="recy-status-badge recy-status-cancelled">Failed</span>
                            @else
                                <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row g-4">
                        <div class="col-lg-7">
                            <h6 class="fw-bold mb-3">Produk Dipesan</h6>

                            @foreach ($order->items as $item)
                                <div class="recy-order-item d-flex justify-content-between gap-3">
                                    <div>
                                        <strong>{{ $item->product->name }}</strong>
                                        <small class="text-muted d-block">
                                            Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </small>
                                    </div>

                                    <strong class="text-success">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </strong>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-5">
                            <div class="recy-eco-box">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Harga</span>
                                    <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Eco Points</span>
                                    <strong class="text-success">+{{ $order->total_eco_points }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Metode Bayar</span>
                                    <strong>{{ $order->payment_method }}</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Kode Bayar</span>
                                    <strong>{{ $order->payment_code ?? '-' }}</strong>
                                </div>
                            </div>

                            @if ($order->payment_status !== 'paid')
                                <form action="{{ route('orders.pay', $order->order_code) }}" method="POST" class="mt-3">
                                    @csrf

                                    <button class="recy-btn-primary w-100">
                                        Bayar Sekarang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="recy-empty-state">
                    <div class="recy-animated-icon mx-auto mb-3">
                        <span class="recy-icon-cart">🛒</span>
                    </div>

                    <h4 class="fw-bold">Belum ada pesanan</h4>

                    <p class="text-muted">
                        Mulai belanja produk eco-friendly pertamamu.
                    </p>

                    <a href="{{ route('products.index') }}" class="recy-btn-primary text-decoration-none">
                        Belanja Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>