<x-app-layout>
    <div class="bg-[#F6F8F3] min-h-screen py-5">
        <div class="container">
            <div class="mb-4">
                <h1 class="fw-bold">Dashboard Recyclick</h1>
                <p class="text-muted mb-0">
                    Selamat datang, {{ Auth::user()->name }}. Pantau aktivitas belanja ramah lingkungan kamu di sini.
                </p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Eco Points</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ Auth::user()->eco_points }}
                            </h2>
                            <p class="text-muted small mb-0">
                                Poin dari pembelian produk ramah lingkungan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Total Pesanan</small>
                            <h2 class="fw-bold mb-0">
                                {{ Auth::user()->orders()->count() }}
                            </h2>
                            <p class="text-muted small mb-0">
                                Jumlah transaksi yang pernah kamu buat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <small class="text-muted">Dampak Hijau</small>
                            <h2 class="fw-bold text-success mb-0">
                                {{ Auth::user()->eco_points * 2 }}x
                            </h2>
                            <p class="text-muted small mb-0">
                                Estimasi kontribusi pengurangan limbah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="fw-bold">Belanja Produk Eco</h4>
                            <p class="text-muted">
                                Lanjutkan belanja produk reusable, recycled, dan zero waste.
                            </p>
                            <a href="{{ route('products.index') }}" class="btn btn-success rounded-pill px-4">
                                Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h4 class="fw-bold">Riwayat Pesanan</h4>
                            <p class="text-muted">
                                Cek status dan detail pesanan yang sudah kamu buat.
                            </p>
                            <a href="{{ route('orders.history') }}" class="btn btn-outline-success rounded-pill px-4">
                                Lihat Riwayat
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role === 'admin')
                <div class="alert alert-success rounded-4 mt-4">
                    Kamu login sebagai admin. Nanti halaman ini akan kita upgrade menjadi dashboard admin lengkap.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>