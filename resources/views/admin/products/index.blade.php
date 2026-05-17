<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold">Kelola Produk</h1>
                    <p class="text-muted mb-0">Manajemen produk Recyclick.</p>
                </div>

                <a href="{{ route('admin.products.create') }}" class="btn btn-success rounded-pill px-4">
                    + Tambah Produk
                </a>
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
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Badge</th>
                                    <th>Eco Points</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($products as $product)
                                    <tr>

                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    style="height: 55px; width: 55px; object-fit: cover;" class="rounded-3">
                                            @else
                                                <span class="text-muted small">No Image</span>
                                            @endif
                                        </td>

                                        <td class="fw-semibold">{{ $product->name }}</td>

                                        <td>{{ $product->category->name }}</td>

                                        <td>
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>

                                        <td>{{ $product->stock }}</td>

                                        <td>
                                            @if ($product->eco_badge)
                                                <span class="badge bg-success">
                                                    {{ $product->eco_badge }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            +{{ $product->eco_points_reward }}
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-outline-success">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus produk ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            Produk belum ada.
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