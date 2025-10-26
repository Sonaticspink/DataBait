<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

@include('partials.navbar', ['active' => 'library'])

<div class="container py-4">
    <h2 class="mb-4">Your Library</h2>

    @if ($games->isEmpty())
    <p class="text-secondary">You don’t own any games yet.</p>
    @else
    <div class="row g-4">
        @foreach ($games as $entry)
        @php $game = $entry->product; @endphp
        <div class="col-md-3">
            <div class="card bg-secondary text-light shadow h-100">
                @if ($game && $game->cover_image)
                <img src="{{ asset($game->cover_image) }}" class="card-img-top" alt="cover">
                @else
                <div class="bg-dark text-center py-5 text-muted">No cover</div>
                @endif

                <div class="card-body">
                    <h6 class="card-title mb-1">{{ $game->title ?? 'Unknown Game' }}</h6>
                    <div class="small text-muted">{{ $game->product_genres }}</div>
                    <div class="small text-muted">Owned</div>
                </div>

                <div class="card-footer bg-dark text-center">
                    <button class="btn btn-outline-light btn-sm w-100" disabled>Play</button>
                    {{-- future: link to game details / installer --}}
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
