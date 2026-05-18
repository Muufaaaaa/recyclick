<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success rounded-pill mb-4">
                ← Kembali
            </a>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-3">Detail Pesanan</h3>

                            <p><strong>Kode:</strong> {{ $order->order_code }}</p>
                            <p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
                            <p><strong>No HP:</strong> {{ $order->phone }}</p>
                            <p><strong>Alamat:</strong> {{ $order->address }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>

                            <p>
                                <strong>Status Pembayaran:</strong>
                                @if ($order->payment_status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning text-dark">Unpaid</span>
                                @endif
                            </p>

                            @if ($order->paid_at)
                                <p>
                                    <strong>Dibayar Pada:</strong>
                                    {{ $order->paid_at->format('d M Y H:i') }}
                                </p>
                            @endif

                            <p>
                                <strong>Status Pesanan:</strong>
                                <span class="badge bg-success">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-3">Produk Dipesan</h3>

                            @foreach ($order->items as $item)
                                <div class="d-flex justify-content-between border-bottom py-3">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                                        <small class="text-muted">
                                            Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </small>
                                    </div>

                                    <strong>
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </strong>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between mt-4">
                                <h5 class="fw-bold">Total</h5>
                                <h5 class="fw-bold text-success">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-3">Ubah Status Pesanan</h3>

                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="form-select rounded-pill mb-3">
                                    <option value="pending" @selected($order->status === 'pending')>Pending</option>
                                    <option value="processing" @selected($order->status === 'processing')>Processing
                                    </option>
                                    <option value="completed" @selected($order->status === 'completed')>Completed</option>
                                    <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                                </select>

                                <button class="btn btn-success rounded-pill px-4">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-3">Ringkasan Eco</h3>

                            <p class="text-muted mb-1">Eco Points Didapat</p>
                            <h3 class="text-success fw-bold">
                                +{{ $order->total_eco_points }}
                            </h3>

                            <hr>

                            <p class="text-muted mb-1">Status Pembayaran</p>

                            @if ($order->payment_status === 'paid')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    Paid
                                </span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                    Unpaid
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>