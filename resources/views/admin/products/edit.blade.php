<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">

            <div class="recy-admin-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-light text-success rounded-pill mb-3">
                            Edit Product
                        </span>

                        <h1 class="fw-bold mb-2">
                            Edit Produk
                        </h1>

                        <p class="mb-0">
                            Perbarui informasi produk Recyclick.
                        </p>
                    </div>

                    <a href="{{ route('admin.products.index') }}"
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
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="recy-admin-form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control recy-form-control"
                                    value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="recy-admin-form-label">Kategori</label>
                                <select name="category_id" class="form-select recy-form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="recy-admin-form-label">Deskripsi</label>
                                <textarea name="description" class="form-control recy-form-control" rows="5"
                                    required>{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Harga</label>
                                    <input type="number" name="price" class="form-control recy-form-control"
                                        value="{{ old('price', $product->price) }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Stok</label>
                                    <input type="number" name="stock" class="form-control recy-form-control"
                                        value="{{ old('stock', $product->stock) }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="recy-admin-form-label">Eco Points</label>
                                    <input type="number" name="eco_points_reward" class="form-control recy-form-control"
                                        value="{{ old('eco_points_reward', $product->eco_points_reward) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="recy-admin-form-label">Eco Badge</label>
                                    <input type="text" name="eco_badge" class="form-control recy-form-control"
                                        value="{{ old('eco_badge', $product->eco_badge) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="recy-admin-form-label">Eco Impact</label>
                                    <input type="number" name="eco_impact" class="form-control recy-form-control"
                                        value="{{ old('eco_impact', $product->eco_impact) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-4">
                                <label class="recy-admin-form-label">Gambar Produk</label>

                                @if ($product->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="recy-admin-preview-img"
                                            alt="{{ $product->name }}">
                                    </div>
                                @else
                                    <div
                                        class="recy-admin-preview-img d-flex align-items-center justify-content-center text-muted mb-3">
                                        No Image
                                    </div>
                                @endif

                                <input type="file" name="image" class="form-control recy-form-control" accept="image/*">

                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti gambar.
                                </small>
                            </div>

                            <div class="recy-admin-detail-card">
                                <h6 class="fw-bold mb-3">Ringkasan Produk</h6>

                                <div class="recy-admin-info-row">
                                    <span>Slug</span>
                                    <strong>{{ $product->slug }}</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Stok</span>
                                    <strong>{{ $product->stock }}</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Eco Points</span>
                                    <strong class="text-success">+{{ $product->eco_points_reward }}</strong>
                                </div>

                                <div class="recy-admin-info-row">
                                    <span>Dibuat</span>
                                    <strong>{{ $product->created_at->format('d M Y') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2 flex-wrap">
                        <button class="recy-btn-primary">
                            Update Produk
                        </button>

                        <a href="{{ route('admin.products.index') }}" class="recy-btn-outline text-decoration-none">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>