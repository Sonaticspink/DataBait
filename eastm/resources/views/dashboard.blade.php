<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<!-- 🌟 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/dashboard">
            <img src="{{ asset('img/Meat.png') }}" alt="Logo" width="40" class="me-2">
            <span class="fw-bold">Meats</span>
        </a>

        <!-- Toggle for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="/dashboard" class="nav-link active">Home</a></li>
                <li class="nav-item"><a href="/store" class="nav-link">Store</a></li>
                <li class="nav-item"><a href="/library" class="nav-link">Library</a></li>
                <li class="nav-item"><a href="/wishlist" class="nav-link">Wishlist</a></li>
            </ul>

            <!-- User Info + Logout -->
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

<!-- 🌟 Main Content -->
<div class="container mt-5">
    <h2>Welcome, {{ Auth::user()->username }}</h2>
    <p>You are logged in as {{ Auth::user()->email }}</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
