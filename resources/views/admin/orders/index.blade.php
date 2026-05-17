<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="mb-4">
                <h1 class="fw-bold">Kelola Pesanan</h1>
                <p class="text-muted mb-0">Pantau dan ubah status pesanan pelanggan.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Eco Points</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="fw-semibold">{{ $order->order_code }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="text-success">+{{ $order->total_eco_points }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="btn btn-sm btn-outline-success">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Belum ada pesanan.
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