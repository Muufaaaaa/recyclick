<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Category Management
                        </span>

                        <h1 class="fw-bold mb-2">
                            Kelola Kategori
                        </h1>

                        <p class="mb-0">
                            Atur kategori produk ramah lingkungan di Recyclick.
                        </p>
                    </div>

                    <div class="recy-admin-toolbar">
                        <a href="{{ route('admin.dashboard') }}"
                            class="btn btn-light rounded-pill fw-bold text-success">
                            Admin Panel
                        </a>

                        <a href="{{ route('admin.categories.create') }}"
                            class="btn btn-outline-light rounded-pill fw-bold">
                            + Tambah Kategori
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="recy-admin-card">
                <div class="table-responsive">
                    <table class="table recy-admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Deskripsi</th>
                                <th>Total Produk</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <strong>{{ $category->name }}</strong>
                                    </td>

                                    <td>
                                        <span class="text-muted">
                                            {{ $category->slug }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $category->description ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-success rounded-pill">
                                            {{ $category->products_count }} produk
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-success recy-admin-action">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-outline-danger recy-admin-action"
                                                    onclick="return confirm('Hapus kategori ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="recy-admin-empty">
                                            <div class="recy-animated-icon mx-auto mb-3">
                                                <span class="recy-icon-recycle">♻</span>
                                            </div>

                                            <h5 class="fw-bold">Kategori belum ada</h5>

                                            <p class="text-muted mb-0">
                                                Tambahkan kategori pertama untuk produk Recyclick.
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