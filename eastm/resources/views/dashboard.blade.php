<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - MAETS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #4c4c4c 0%, #0e0e0e 100%);
            color: #fff;
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
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

        /* Profile Header */
        .profile-header {
            background: linear-gradient(90deg, #2e2e2e, #1c1c1c);
            padding: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            margin-top: 60px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 5px;
            margin-right: 30px;
            border: 2px solid #555;
        }
        .profile-header h2 {
            color: #fff;
            margin-bottom: 5px;
        }
        .profile-header p {
            color: #bbb;
            margin: 0;
        }

        /* Details Section */
        .profile-details {
            margin-top: 40px;
        }
        .detail-card {
            background: rgba(30, 30, 30, 0.85);
            border: 1px solid #555;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .detail-card h4 {
            color: #979797ff;
            margin-bottom: 10px;
        }
        .detail-card p {
            color: #ccc;
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
                <li class="nav-item"><a href="/store" class="nav-link">STORE</a></li>
                <li class="nav-item"><a href="/library" class="nav-link">LIBRARY</a></li>
                <li class="nav-item"><a href="/wishlist" class="nav-link">WISHLIST</a></li>
                <li class="nav-item"><a href="/dashboard" class="nav-link">{{ Auth::user()->username }}</a></li>
            </ul>

            <div class="user-box d-flex align-items-center p-1 px-2 rounded">
                <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('img/Meat.png') }}" 
                    alt="Profile" 
                    class="rounded me-2 user-avatar">
                <span class="me-3 fw-semibold">{{ Auth::user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- 🌟 Profile Section -->
<div class="container">
    <div class="profile-header">
        <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('img/Meat.png') }}" alt="Profile Picture">
        <div>
            <h2>{{ Auth::user()->username }}</h2>
            <p>{{ Auth::user()->email }}</p>
        </div>
    </div>

    <div class="profile-details">
        <div class="detail-card">
            <h4>Account Info</h4>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Member Since:</strong> {{ Auth::user()->registration_date ?? 'N/A' }}</p>
        </div>

        <div class="detail-card">
            <h4>Game Library</h4>

            @if($gameCount > 0)
                <p>You currently have <strong>{{ $gameCount }}</strong> game{{ $gameCount > 1 ? 's' : '' }} in your library.</p>
            @else
                <p>You currently have no games in your library.</p>
            @endif
        </div>

        <div class="detail-card">
            <h4>Wishlist</h4>

            @if($wishlistCount > 0)
                <p>You currently have <strong>{{ $wishlistCount }}</strong> game{{ $wishlistCount > 1 ? 's' : '' }} in your wishlist.</p>
            @else
                <p>Your wishlist is empty. Browse the store to add games!</p>
            @endif
        </div>

    </div>
</div>

<footer>
    <div>© 2025 MAETS. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
