<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Order Management
                        </span>

                        <h1 class="fw-bold mb-2">
                            Kelola Pesanan
                        </h1>

                        <p class="mb-0">
                            Pantau transaksi, pembayaran, dan status pesanan pelanggan Recyclick.
                        </p>
                    </div>

                    <div class="recy-admin-toolbar">
                        <a href="{{ route('admin.dashboard') }}"
                            class="btn btn-light rounded-pill fw-bold text-success">
                            Admin Panel
                        </a>

                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-light rounded-pill fw-bold">
                            Kelola Produk
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="recy-admin-card">
                <div class="table-responsive">
                    <table class="table recy-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Eco Points</th>
                                <th>Status Order</th>
                                <th>Pembayaran</th>
                                <th>Tanggal</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>
                                        <strong>{{ $order->order_code }}</strong>
                                        <div class="recy-admin-meta">
                                            {{ $order->payment_method }}
                                        </div>
                                    </td>

                                    <td>
                                        <strong>{{ $order->user->name }}</strong>
                                        <div class="recy-admin-meta">
                                            {{ $order->user->email }}
                                        </div>
                                    </td>

                                    <td>
                                        <strong class="text-success">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                    <td>
                                        <strong class="text-success">
                                            +{{ $order->total_eco_points }}
                                        </strong>
                                    </td>

                                    <td>
                                        @if ($order->status === 'pending')
                                            <span class="recy-status-badge recy-status-unpaid">Pending</span>
                                        @elseif ($order->status === 'processing')
                                            <span class="recy-status-badge recy-status-processing">Processing</span>
                                        @elseif ($order->status === 'completed')
                                            <span class="recy-status-badge recy-status-paid">Completed</span>
                                        @else
                                            <span class="recy-status-badge recy-status-cancelled">Cancelled</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($order->payment_status === 'paid')
                                            <span class="recy-status-badge recy-status-paid">Paid</span>
                                        @elseif ($order->payment_status === 'failed')
                                            <span class="recy-status-badge recy-status-cancelled">Failed</span>
                                        @else
                                            <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="btn btn-sm btn-outline-success recy-admin-action">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="recy-admin-empty">
                                            <div class="recy-animated-icon mx-auto mb-3">
                                                <span class="recy-icon-cart">🛒</span>
                                            </div>

                                            <h5 class="fw-bold">Belum ada pesanan</h5>
                                            <p class="text-muted mb-0">
                                                Pesanan dari pelanggan akan tampil di halaman ini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>