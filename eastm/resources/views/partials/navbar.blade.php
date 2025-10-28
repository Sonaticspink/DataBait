<nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/dashboard">
            <img src="{{ asset('img/Meat.png') }}" alt="Logo" width="40" class="me-2">
            <span class="fw-bold">Meats</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="/dashboard" class="nav-link {{ ($active ?? '') === 'home' ? 'active' : '' }}">Home</a></li>
                <li class="nav-item"><a href="/" class="nav-link {{ ($active ?? '') === 'store' ? 'active' : '' }}">Store</a></li>
                <li class="nav-item"><a href="/library" class="nav-link {{ ($active ?? '') === 'library' ? 'active' : '' }}">Library</a></li>
                <li class="nav-item"><a href="/wishlist" class="nav-link {{ ($active ?? '') === 'wishlist' ? 'active' : '' }}">Wishlist</a></li>
            </ul>

            {{-- 🛒 CART BUTTON --}}
            <a href="{{ route('cart') }}"
               class="btn btn-outline-light d-flex align-items-center gap-2 px-3 py-1 rounded-pill shadow-sm position-relative"
               style="border-color:#66c0f4; color:#66c0f4;">

                <i class="bi bi-cart-fill"></i>
                <span>Cart</span>

                @if(isset($cartCount) && $cartCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                      style="background-color:#66c0f4; color:#fff; font-size:.65rem;">
            {{ $cartCount }}
        </span>
                @endif
            </a>

            <div class="d-flex align-items-center">
                <span class="me-3">👤 {{ Auth::user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
