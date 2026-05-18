<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <h1 class="fw-bold mb-4">Riwayat Pesanan</h1>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($orders as $order)
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $order->order_code }}</h5>
                                <small class="text-muted">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </small>

                                <div class="mt-2 d-flex gap-2 flex-wrap">
                                    <span class="badge bg-success">
                                        Order: {{ ucfirst($order->status) }}
                                    </span>

                                    @if ($order->payment_status === 'paid')
                                        <span class="badge bg-success">
                                            Payment: Paid
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Payment: Unpaid
                                        </span>
                                    @endif

                                    <span class="badge bg-secondary">
                                        {{ $order->payment_method }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-end mt-3 mt-md-0">
                                <p class="fw-bold mt-2 mb-0">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>

                                <small class="text-success">
                                    +{{ $order->total_eco_points }} Eco Points
                                </small>

                                @if ($order->payment_status !== 'paid' && $order->payment_method !== 'COD')
                                    <div class="mt-2">
                                        <a href="{{ route('orders.payment', $order->order_code) }}"
                                            class="btn btn-sm btn-warning rounded-pill">
                                            Bayar Sekarang
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr>

                        @foreach ($order->items as $item)
                            <div class="d-flex justify-content-between">
                                <span>
                                    {{ $item->product->name }} x {{ $item->quantity }}
                                </span>

                                <span>
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center py-5">
                        <h4 class="fw-bold">Belum ada pesanan</h4>

                        <p class="text-muted">
                            Mulai belanja produk eco-friendly pertamamu.
                        </p>

                        <a href="{{ route('products.index') }}" class="btn btn-success rounded-pill px-4">
                            Belanja Sekarang
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>