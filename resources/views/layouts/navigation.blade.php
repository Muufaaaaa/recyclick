<nav class="recy-shop-navbar">
    <div class="container">
        <div class="recy-main-nav d-flex justify-content-between align-items-center">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="recy-logo-animated text-decoration-none">
                <span class="recy-logo-icon">♻</span>
                <span>Recyclick</span>
            </a>

            {{-- DESKTOP MENU --}}
            <div class="recy-desktop-menu d-none d-lg-flex align-items-center gap-4">
                <a href="{{ route('products.index') }}" class="recy-nav-link">Produk</a>
                <a href="{{ route('home') }}#categories" class="recy-nav-link">Kategori</a>
                <a href="{{ route('home') }}#eco-news" class="recy-nav-link">Berita & Acara</a>
                <a href="{{ route('home') }}#delivery" class="recy-nav-link">Delivery</a>
            </div>

            {{-- DESKTOP SEARCH --}}
            <form action="{{ route('products.index') }}" method="GET" class="recy-nav-search d-none d-xl-flex">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                <button type="submit">⌕</button>
            </form>

            {{-- DESKTOP ACTIONS --}}
            <div class="d-none d-lg-flex align-items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="recy-nav-link">Login</a>
                    <a href="{{ route('register') }}" class="recy-mini-btn">Register</a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" class="recy-nav-link">Account</a>
                    <a href="{{ route('wishlist.index') }}" class="recy-nav-link">Wishlist</a>
                    <a href="{{ route('cart.index') }}" class="recy-nav-link">Cart</a>
                    <a href="{{ route('chat.index') }}" class="recy-nav-link">Chat</a>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="recy-mini-btn">Admin</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

            {{-- MOBILE TOGGLE --}}
            <button class="recy-mobile-toggle d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#recyMobileMenu">
                ☰
            </button>
        </div>

        {{-- MOBILE MENU --}}
        <div class="collapse d-lg-none" id="recyMobileMenu">
            <div class="recy-mobile-menu">

                <form action="{{ route('products.index') }}" method="GET" class="recy-mobile-search mb-3">
                    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                    <button type="submit">Cari</button>
                </form>

                <a href="{{ route('products.index') }}" class="recy-mobile-link">Produk</a>
                <a href="{{ route('home') }}#categories" class="recy-mobile-link">Kategori</a>
                <a href="{{ route('home') }}#eco-news" class="recy-mobile-link">Berita & Acara</a>
                <a href="{{ route('home') }}#delivery" class="recy-mobile-link">Delivery</a>

                @guest
                    <hr>
                    <a href="{{ route('login') }}" class="recy-mobile-link">Login</a>
                    <a href="{{ route('register') }}" class="recy-mobile-link text-success fw-bold">Register</a>
                @endguest

                @auth
                    <hr>
                    <a href="{{ route('dashboard') }}" class="recy-mobile-link">Dashboard</a>
                    <a href="{{ route('cart.index') }}" class="recy-mobile-link">Keranjang</a>
                    <a href="{{ route('wishlist.index') }}" class="recy-mobile-link">Wishlist</a>
                    <a href="{{ route('orders.history') }}" class="recy-mobile-link">Riwayat</a>
                    <a href="{{ route('chat.index') }}" class="recy-mobile-link">Chat Admin</a>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="recy-mobile-link text-success fw-bold">
                            Admin Panel
                        </a>
                    @endif

                    <div class="mt-3">
                        <span class="badge bg-success rounded-pill mb-2">
                            {{ Auth::user()->eco_points }} Eco Points
                        </span>

                        <p class="mb-2 fw-semibold">
                            {{ Auth::user()->name }}
                        </p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>