<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Product Management
                        </span>

                        <h1 class="fw-bold mb-2">
                            Kelola Produk
                        </h1>

                        <p class="mb-0">
                            Tambah, edit, hapus, dan pantau produk ramah lingkungan Recyclick.
                        </p>
                    </div>

                    <div class="recy-admin-toolbar">
                        <a href="{{ route('admin.dashboard') }}"
                            class="btn btn-light rounded-pill fw-bold text-success">
                            Admin Panel
                        </a>

                        <a href="{{ route('admin.products.create') }}"
                            class="btn btn-outline-light rounded-pill fw-bold">
                            + Tambah Produk
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
                                            <img src="{{ asset('storage/' . $product->image) }}" class="recy-admin-product-img"
                                                alt="{{ $product->name }}">
                                        @else
                                            <div
                                                class="recy-admin-product-img d-flex align-items-center justify-content-center text-muted small">
                                                -
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <div class="recy-admin-meta">
                                            {{ \Illuminate\Support\Str::limit($product->description, 45) }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $product->category->name }}
                                    </td>

                                    <td>
                                        <strong class="text-success">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                    <td>
                                        @if ($product->stock <= 0)
                                            <span class="badge bg-danger rounded-pill">Habis</span>
                                        @elseif ($product->stock <= 5)
                                            <span class="badge bg-warning text-dark rounded-pill">
                                                {{ $product->stock }} tersisa
                                            </span>
                                        @else
                                            <span class="badge bg-success rounded-pill">
                                                {{ $product->stock }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($product->eco_badge)
                                            <span class="recy-badge">
                                                {{ $product->eco_badge }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong class="text-success">
                                            +{{ $product->eco_points_reward }}
                                        </strong>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-outline-success recy-admin-action">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-outline-danger recy-admin-action"
                                                    onclick="return confirm('Hapus produk ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="recy-admin-empty">
                                            <div class="recy-animated-icon mx-auto mb-3">
                                                <span class="recy-icon-cart">🛒</span>
                                            </div>

                                            <h5 class="fw-bold">Produk belum ada</h5>
                                            <p class="text-muted mb-0">
                                                Tambahkan produk pertama Recyclick dari tombol Tambah Produk.
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