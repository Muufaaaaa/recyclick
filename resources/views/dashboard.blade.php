<x-app-layout>
    <div class="recy-page py-5">
        <div class="container">
            @php
                $user = Auth::user();
                $totalOrders = $user->orders()->count();
                $latestOrders = $user->orders()->latest()->take(3)->get();
                $wishlistCount = $user->wishlists()->count();
                $cartItemsCount = $user->cart ? $user->cart->items()->sum('quantity') : 0;
                $paidOrders = $user->orders()->where('payment_status', 'paid')->count();
            @endphp

            <div class="recy-dashboard-hero mb-4">
                <div style="position: relative; z-index: 2;">
                    <span class="badge bg-light text-success rounded-pill mb-3">
                        User Dashboard
                    </span>

                    <h1 class="fw-bold mb-2">
                        Halo, {{ $user->name }}
                    </h1>

                    <p class="mb-0 opacity-75">
                        Pantau eco points, pesanan, wishlist, dan aktivitas belanja ramah lingkungan kamu.
                    </p>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-recycle">♻</span>
                        </div>

                        <small class="text-muted">Eco Points</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $user->eco_points }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Poin dari transaksi eco-friendly.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-cart">🛒</span>
                        </div>

                        <small class="text-muted">Total Pesanan</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $totalOrders }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Jumlah order yang pernah dibuat.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-leaf">♡</span>
                        </div>

                        <small class="text-muted">Wishlist</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $wishlistCount }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Produk yang kamu simpan.
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="recy-dashboard-card">
                        <div class="recy-animated-icon mb-3">
                            <span class="recy-icon-payment">💳</span>
                        </div>

                        <small class="text-muted">Order Paid</small>

                        <h2 class="fw-bold text-success mb-0">
                            {{ $paidOrders }}
                        </h2>

                        <p class="text-muted small mt-2 mb-0">
                            Pesanan yang sudah dibayar.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <a href="{{ route('products.index') }}" class="recy-dashboard-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-cart">🛒</span>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Belanja Produk</h5>
                                <small class="text-muted">
                                    Lihat katalog Recyclick.
                                </small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="{{ route('cart.index') }}" class="recy-dashboard-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-cart">🛍</span>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Keranjang</h5>
                                <small class="text-muted">
                                    {{ $cartItemsCount }} item sedang menunggu checkout.
                                </small>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="{{ route('chat.index') }}" class="recy-dashboard-action">
                        <div class="d-flex align-items-center gap-3">
                            <div class="recy-animated-icon">
                                <span class="recy-icon-chat">💬</span>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">Chat Admin</h5>
                                <small class="text-muted">
                                    Tanya produk atau pesanan.
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="recy-order-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold mb-1">Pesanan Terbaru</h4>
                                <p class="text-muted mb-0">
                                    Tiga order terakhir yang kamu buat.
                                </p>
                            </div>

                            <a href="{{ route('orders.history') }}" class="btn btn-outline-success rounded-pill">
                                Lihat Semua
                            </a>
                        </div>

                        @forelse ($latestOrders as $order)
                            <div class="recy-order-item d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <strong>{{ $order->order_code }}</strong>

                                    <small class="text-muted d-block">
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>

                                <div class="text-end">
                                    <strong class="text-success d-block">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </strong>

                                    @if ($order->payment_status === 'paid')
                                        <span class="recy-status-badge recy-status-paid">Paid</span>
                                    @else
                                        <span class="recy-status-badge recy-status-unpaid">Unpaid</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <div class="recy-animated-icon mx-auto mb-3">
                                    <span class="recy-icon-cart">🛒</span>
                                </div>

                                <h5 class="fw-bold">Belum ada pesanan</h5>

                                <p class="text-muted">
                                    Mulai checkout produk eco-friendly pertamamu.
                                </p>

                                <a href="{{ route('products.index') }}" class="recy-btn-primary text-decoration-none">
                                    Belanja Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="recy-dashboard-card">
                        <h4 class="fw-bold mb-3">Green Impact Summary</h4>

                        <div class="recy-eco-box">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Eco Points</span>
                                <strong class="text-success">{{ $user->eco_points }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Estimasi Dampak</span>
                                <strong class="text-success">{{ $user->eco_points * 2 }}x</strong>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span>Wishlist Eco</span>
                                <strong class="text-success">{{ $wishlistCount }} produk</strong>
                            </div>
                        </div>

                        <p class="text-muted small mt-3 mb-0">
                            Angka ini bersifat simbolis untuk menunjukkan kontribusi pengguna terhadap gaya hidup
                            berkelanjutan.
                        </p>
                    </div>

                    @if ($user->role === 'admin')
                        <div class="alert alert-success rounded-4 mt-4">
                            Kamu login sebagai admin. Buka
                            <a href="{{ route('admin.dashboard') }}" class="fw-bold text-success">
                                Admin Panel
                            </a>
                            untuk mengelola sistem.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>