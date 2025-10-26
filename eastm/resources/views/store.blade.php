<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

{{-- Navbar (same as dashboard) --}}
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
                <li class="nav-item"><a href="/dashboard" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/store" class="nav-link active">Store</a></li>
                <li class="nav-item"><a href="/library" class="nav-link">Library</a></li>
                <li class="nav-item"><a href="/wishlist" class="nav-link">Wishlist</a></li>
            </ul>

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

<div class="container py-4">
    <h2 class="mb-4">Store</h2>

    @if ($products->isEmpty())
    <p class="text-secondary">No games in store yet.</p>
    @else
    <div class="row g-4">
        @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card bg-secondary text-light h-100 shadow">
                @if ($product->cover_image)
                <img src="{{ asset($product->cover_image) }}" class="card-img-top" alt="cover">
                @else
                <div class="bg-dark text-center py-5 text-muted">No cover</div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="small text-muted mb-1">{{ $product->product_genres }}</p>
                    <p class="small text-muted mb-1">
                        Dev: {{ $product->developer ?? '—' }} |
                        Pub: {{ $product->publisher ?? '—' }}
                    </p>
                    <p class="fw-bold mt-auto mb-2">${{ number_format($product->price, 2) }}</p>

                    <div class="d-flex flex-wrap gap-2">
                        {{-- Add to Wishlist --}}
                        @if (in_array($product->product_id, $wishlistProductIds))
                        <span class="badge bg-info text-dark">In Wishlist</span>
                        @else
                        <form method="POST" action="{{ route('wishlist.add', $product->product_id) }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm" type="submit">
                                + Wishlist
                            </button>
                        </form>
                        @endif

                        {{-- Add to Library --}}
                        @if (in_array($product->product_id, $ownedProductIds))
                        <span class="badge bg-success">Owned</span>
                        @else
                        <form method="POST" action="{{ route('library.add', $product->product_id) }}">
                            @csrf
                            <button class="btn btn-light btn-sm text-dark" type="submit">
                                Add to Library
                            </button>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
