<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

@include('partials.navbar', ['active' => 'wishlist'])

<div class="container py-4">
    <h2 class="mb-4">Your Wishlist</h2>

    @if ($items->isEmpty())
    <p class="text-secondary">Your wishlist is empty.</p>
    @else
    <div class="list-group">
        @foreach ($items as $row)
        @php $game = $row->product; @endphp
        <div class="list-group-item bg-secondary text-light mb-2 rounded border-0 shadow d-flex flex-wrap justify-content-between align-items-start">
            <div class="d-flex">
                @if ($game && $game->cover_image)
                <img src="{{ asset($game->cover_image) }}" alt="cover" class="me-3 rounded" style="width:80px; height:80px; object-fit:cover;">
                @else
                <div class="me-3 bg-dark d-flex align-items-center justify-content-center rounded" style="width:80px; height:80px;">
                    <span class="text-muted small">No cover</span>
                </div>
                @endif
                <div>
                    <div class="fw-bold">{{ $game->title ?? 'Unknown Game' }}</div>
                    <div class="small text-muted">{{ $game->product_genres }}</div>
                    <div class="small">${{ $game ? number_format($game->price, 2) : '0.00' }}</div>
                    <div class="small text-muted">Added: {{ $row->added_at ?? '-' }}</div>
                </div>
            </div>

            <div class="d-flex flex-column gap-2 mt-3 mt-md-0">
                {{-- Add to Library --}}
                @if ($game)
                <form method="POST" action="{{ route('library.add', $game->product_id) }}">
                    @csrf
                    <button class="btn btn-light btn-sm text-dark" type="submit">
                        Add to Library
                    </button>
                </form>
                @endif

                {{-- Remove from Wishlist --}}
                @if ($game)
                <form method="POST" action="{{ route('wishlist.remove', $game->product_id) }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        Remove
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
