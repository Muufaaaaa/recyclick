<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Edit Category
                        </span>

                        <h1 class="fw-bold mb-2">
                            Edit Kategori
                        </h1>

                        <p class="mb-0">
                            Perbarui informasi kategori produk.
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
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="recy-admin-form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control recy-form-control"
                            value="{{ old('name', $category->name) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="recy-admin-form-label">Deskripsi</label>
                        <textarea name="description" class="form-control recy-form-control"
                            rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="recy-admin-detail-card mb-4">
                        <h6 class="fw-bold mb-3">Ringkasan Kategori</h6>

                        <div class="recy-admin-info-row">
                            <span>Slug</span>
                            <strong>{{ $category->slug }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Total Produk</span>
                            <strong>{{ $category->products()->count() }}</strong>
                        </div>

                        <div class="recy-admin-info-row">
                            <span>Dibuat</span>
                            <strong>{{ $category->created_at->format('d M Y') }}</strong>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button class="recy-btn-primary">
                            Update Kategori
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