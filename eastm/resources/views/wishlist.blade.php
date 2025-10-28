@extends('layouts.maets')

@section('title', 'Wishlist - MAETS')

@section('content')
<style>
    .wishlist-wrapper {
        max-width: 900px;
        margin: 2rem auto;
    }
    .wishlist-header {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: .5rem;
    }
    .wishlist-item {
        background: rgba(40, 40, 40, 0.85);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        align-items: flex-start;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .wishlist-item:hover {
        background: rgba(50, 50, 50, 0.9);
        transition: background 0.2s;
    }
    .wishlist-left {
        display: flex;
        align-items: flex-start;
    }
    .wishlist-thumb {
        width: 90px;
        height: 90px;
        border-radius: 6px;
        overflow: hidden;
        background-color: #0e1116;
        border: 1px solid rgba(255,255,255,0.07);
        margin-right: 1rem;
        flex-shrink: 0;
    }
    .wishlist-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .wishlist-info {
        line-height: 1.4;
    }
    .wishlist-title {
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
    }
    .wishlist-genre {
        color: #8b949e;
        font-size: .85rem;
    }
    .wishlist-price {
        color: #fff;
        font-size: .85rem;
    }
    .wishlist-date {
        color: #aaa;
        font-size: .75rem;
    }
    .wishlist-actions {
        display: flex;
        flex-direction: column;
        gap: .5rem;
        align-items: flex-end;
        margin-top: .5rem;
    }
    .btn-add {
        background: linear-gradient(#3cb85c, #2e8b46);
        border: 0;
        color: #fff;
        font-weight: 600;
        padding: .4rem .8rem;
        border-radius: .3rem;
        font-size: .8rem;
    }
    .btn-add:hover {
        background: linear-gradient(#47ca67, #35954e);
    }
    .btn-remove {
        color: #f55;
        border: 1px solid #f55;
        font-size: .8rem;
        padding: .4rem .8rem;
        border-radius: .3rem;
        background: transparent;
    }
    .btn-remove:hover {
        color: #fff;
        background: #f55;
        transition: 0.2s;
    }
</style>

<div class="wishlist-wrapper">
    <div class="wishlist-header">Your Wishlist</div>
    @if (session('success'))
    <div class="mb-3 p-2 rounded"
         style="background:rgba(60,184,92,0.15); border:1px solid #3cb85c; color:#fff; font-size:.9rem;">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="mb-3 p-2 rounded"
         style="background:rgba(255,80,80,0.15); border:1px solid #ff5050; color:#fff; font-size:.9rem;">
        {{ session('error') }}
    </div>
    @endif

    @if ($items->isEmpty())
    <p class="text-secondary">Your wishlist is empty.</p>
    @else
    @foreach ($items as $row)
    @php $game = $row->product; @endphp
    <div class="wishlist-item">
        <div class="wishlist-left">
            <div class="wishlist-thumb">
                @if ($game && $game->cover_image)
                <img src="{{ asset($game->cover_image) }}" alt="cover">
                @else
                <div class="d-flex justify-content-center align-items-center text-muted" style="height:100%;font-size:.8rem;">No cover</div>
                @endif
            </div>

            <div class="wishlist-info">
                <div class="wishlist-title">{{ $game->title ?? 'Unknown Game' }}</div>
                <div class="wishlist-genre">{{ $game->product_genres ?? '' }}</div>
                <div class="wishlist-price">฿{{ $game ? number_format($game->price, 2) : '0.00' }}</div>
                <div class="wishlist-date">Added: {{ $row->added_at ?? '-' }}</div>
            </div>
        </div>

        <div class="wishlist-actions">
            @if ($game)
            {{-- 🛒 Add to Cart --}}
            <form method="POST" action="{{ route('cart.add', $game->product_id) }}">
                @csrf
                <button class="btn-add" type="submit">Add to Cart</button>
            </form>

            {{-- ❌ Remove from Wishlist --}}
            <form method="POST" action="{{ route('wishlist.remove', $game->product_id) }}">
                @csrf
                <button class="btn-remove" type="submit">Remove</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
