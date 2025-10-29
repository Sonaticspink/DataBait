<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MAETS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* === GLOBAL THEME === */
        body {
            background: linear-gradient(180deg, #4c4c4c 0%, #0e0e0e 100%);
            color: #fff;
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(180deg, #2a2a2a 0%, #1a1a1a 100%);
            border-bottom: 1px solid #555;
        }
        .navbar-brand span {
            color: #999;
            font-weight: bold;
            font-size: 22px;
        }
        .navbar-nav .nav-link {
            color: #ddd !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #ccccccff !important;
        }
        .btn-outline-light {
            border-color: #66c0f4;
            color: #66c0f4;
        }
        .btn-outline-light:hover {
            background-color: #66c0f4;
            color: #fff;
        }

        footer {
            background: transparent;
            color: #999;
            font-size: 14px;
            padding: 40px 0 20px;
            text-align: center;
            border-top: 1px solid #333;
            margin-top: 60px;
        }

        .user-box {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid #555;
            border-radius: 8px;
            transition: background 0.2s, border-color 0.2s;
        }
        .user-box:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #555;
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid #555;
        }
        .btn-logout {
            background-color: #555;
            color: #fff;
            border: none;
            padding: 3px 10px;
            font-size: 13px;
            border-radius: 5px;
        }
        .btn-logout:hover {
            background-color: #7e7e7eff;
        }
    </style>
</head>
<body>

<!-- 🌟 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/dashboard">
            <img src="{{ asset('img/Meat.png') }}" alt="Logo" width="40" class="me-2">
            <span>MAETS</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="/" class="nav-link {{ request()->is('store') ? 'active' : '' }}">STORE</a></li>
                <li class="nav-item"><a href="/library" class="nav-link {{ request()->is('library') ? 'active' : '' }}">LIBRARY</a></li>
                <li class="nav-item"><a href="/wishlist" class="nav-link {{ request()->is('wishlist') ? 'active' : '' }}">WISHLIST</a></li>
                <li class="nav-item"><a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">{{ Auth::check() ? Auth::user()->username : 'Guest' }}</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">

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

                {{-- 👤 USER BOX --}}
                <div class="user-box d-flex align-items-center p-1 px-2 rounded">
                    <img src="{{asset('img/Meat.png') }}"
                         alt="Profile"
                         class="rounded me-2 user-avatar">
                    <span class="me-3 fw-semibold">{{ Auth::check() ? Auth::user()->username : 'Guest' }}</span>
                    @if(Auth::check())
                    {{-- Logged in: show logout form --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-logout">Logout</button>
                    </form>
                    @else
                    {{-- Not logged in: show login link --}}
                    <a href="{{ url('/login') }}" class="btn btn-sm btn-logout">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- 🌟 Page Content -->
<div class="container mt-4">
    @yield('content')
</div>

<footer>
    <div>© 2025 MAETS. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
