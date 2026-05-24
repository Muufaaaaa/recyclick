<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Add Category
                        </span>

                        <h1 class="fw-bold mb-2">
                            Tambah Kategori
                        </h1>

                        <p class="mb-0">
                            Buat kategori baru untuk mengelompokkan produk Recyclick.
                        </p>
                    </div>

                    <a href="{{ route('admin.categories.index') }}"
                        class="btn btn-light rounded-pill fw-bold text-success">
                        ← Kembali
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="recy-admin-form-card">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="recy-admin-form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control recy-form-control" value="{{ old('name') }}"
                            placeholder="Contoh: Reusable Product" required>
                    </div>

                    <div class="mb-4">
                        <label class="recy-admin-form-label">Deskripsi</label>
                        <textarea name="description" class="form-control recy-form-control" rows="4"
                            placeholder="Deskripsi singkat kategori...">{{ old('description') }}</textarea>
                    </div>

                    <div class="recy-eco-box mb-4">
                        <h6 class="fw-bold text-success mb-1">
                            Tips Kategori
                        </h6>

                        <small class="text-muted">
                            Gunakan kategori yang jelas seperti Reusable Product, Recycled Craft,
                            Eco Lifestyle, atau Zero Waste agar katalog lebih mudah dipahami user.
                        </small>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button class="recy-btn-primary">
                            Simpan Kategori
                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="recy-btn-outline text-decoration-none">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>