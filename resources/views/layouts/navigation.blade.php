<nav class="bg-white border-bottom shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-4">
            <a class="fw-bold text-success text-decoration-none fs-5" href="{{ route('home') }}">
                Recyclick
            </a>

            <a class="text-dark text-decoration-none" href="{{ route('products.index') }}">
                Produk
            </a>

            @auth
                <a class="text-dark text-decoration-none" href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a class="text-dark text-decoration-none" href="{{ route('cart.index') }}">
                    Keranjang
                </a>

                <a class="text-dark text-decoration-none" href="{{ route('wishlist.index') }}">
                    Wishlist
                </a>

                <a class="text-dark text-decoration-none" href="{{ route('chat.index') }}">
                    Chat
                </a>

                <a class="text-dark text-decoration-none" href="{{ route('orders.history') }}">
                    Riwayat
                </a>

                @if (Auth::user()->role === 'admin')
                    <a class="text-success fw-semibold text-decoration-none" href="{{ route('admin.dashboard') }}">
                        Admin Dashboard
                    </a>
                @endif
            @endauth
        </div>

        <div class="d-flex align-items-center gap-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-success rounded-pill px-3">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success rounded-pill px-3">Register</a>
            @endguest

            @auth
                <span class="badge bg-success rounded-pill">
                    {{ Auth::user()->eco_points }} Eco Points
                </span>

                <span class="fw-semibold">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>