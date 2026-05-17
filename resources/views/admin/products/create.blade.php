<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <h1 class="fw-bold mb-4">Tambah Produk</h1>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select rounded-pill" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="name" class="form-control rounded-pill" value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Produk</label>
                            <input type="file" name="image" class="form-control rounded-pill" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal 2MB.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control rounded-4" rows="4"
                                required>{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" name="price" class="form-control rounded-pill"
                                    value="{{ old('price') }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stock" class="form-control rounded-pill"
                                    value="{{ old('stock') }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Eco Points</label>
                                <input type="number" name="eco_points_reward" class="form-control rounded-pill"
                                    value="{{ old('eco_points_reward', 10) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Eco Badge</label>
                                <input type="text" name="eco_badge" class="form-control rounded-pill"
                                    placeholder="Eco Choice / Recycled / Plastic Free" value="{{ old('eco_badge') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Eco Impact</label>
                                <input type="number" name="eco_impact" class="form-control rounded-pill"
                                    value="{{ old('eco_impact', 1) }}" required>
                            </div>
                        </div>

                        <button class="btn btn-success rounded-pill px-4">
                            Simpan Produk
                        </button>

                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-secondary rounded-pill px-4">
                            Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>