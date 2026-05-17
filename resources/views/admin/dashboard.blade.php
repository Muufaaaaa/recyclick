<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Admin Dashboard</h1>
                    <p class="text-muted mb-0">
                        Ringkasan aktivitas Recyclick.
                    </p>
                </div>

                <div class="d-flex gap-2 mt-3 mt-md-0">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-success rounded-pill">
                        Kelola Produk
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="btn btn-success rounded-pill">
                        Kelola Order
                    </a>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total Produk</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalProducts }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total Order</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalOrders }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total User</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ $totalUsers }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Revenue Completed</small>
                            <h5 class="fw-bold text-success mb-0">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Order Terbaru</h4>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($latestOrders as $order)
                                    <tr>
                                        <td class="fw-semibold">
                                            {{ $order->order_code }}
                                        </td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            Belum ada order.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>