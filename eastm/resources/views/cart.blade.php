@extends('layouts.maets')

@section('title', 'Your Cart - MAETS')

@section('content')
<style>
    .cart-wrapper {
        max-width: 900px;
        margin: 2rem auto;
        background: rgba(30, 30, 30, 0.9);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 10px;
        padding: 1.5rem 2rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }
    .cart-header {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: .5rem;
    }
    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .cart-item:last-child {
        border-bottom: 0;
    }
    .cart-thumb {
        width: 80px;
        height: 80px;
        border-radius: 4px;
        background: #0f141a;
        border: 1px solid rgba(255,255,255,0.07);
        object-fit: cover;
        flex-shrink: 0;
    }
    .cart-info-title {
        color: #fff;
        font-weight: 500;
        font-size: .95rem;
    }
    .cart-info-genre {
        color: #8b949e;
        font-size: .8rem;
    }
    .cart-price {
        color: #fff;
        font-size: .9rem;
        font-weight: 500;
    }
    .cart-total-row {
        display: flex;
        justify-content: space-between;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid rgba(255,255,255,0.07);
        font-size: 1rem;
        color: #fff;
        font-weight: 600;
    }
    .checkout-bar {
        display: flex;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }
    .btn-checkout {
        background: linear-gradient(#3cb85c, #2e8b46);
        border: 0;
        color: #fff;
        font-weight: 600;
        padding: .6rem 1rem;
        border-radius: .3rem;
        text-transform: uppercase;
        font-size: .8rem;
        letter-spacing: .03em;
        min-width: 140px;
    }
    .btn-remove {
        color: #bbb;
        font-size: .8rem;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.3);
        padding: .4rem .6rem;
        border-radius: .3rem;
    }
    .btn-remove:hover {
        color: #fff;
        border-color: rgba(255,255,255,0.6);
    }
</style>

<div class="cart-wrapper">
    <div class="cart-header">Your Cart</div>

    @if ($cartItems->isEmpty())
    <p class="text-secondary">Your cart is empty.</p>
    @else
    @foreach ($cartItems as $row)
    @php $p = $row->product; @endphp
    <div class="cart-item">
        <div class="d-flex align-items-start gap-3">
            @if ($p && $p->cover_image)
            <img src="{{ asset($p->cover_image) }}" class="cart-thumb" alt="cover">
            @else
            <div class="cart-thumb d-flex justify-content-center align-items-center text-muted" style="font-size:.7rem;">
                No<br>Img
            </div>
            @endif

            <div>
                <div class="cart-info-title">{{ $p->title ?? 'Unknown Game' }}</div>
                <div class="cart-info-genre">{{ $p->product_genres ?? '' }}</div>
                <div class="text-muted" style="font-size:.8rem;">
                    {{ $p->developer ?? '' }} &bullet;
                    {{ $p->publisher ?? '' }}
                </div>

                <form method="POST" action="{{ route('cart.remove', $p->product_id) }}" class="mt-2">
                    @csrf
                    <button type="submit" class="btn-remove btn-sm">Remove</button>
                </form>
            </div>
        </div>

        <div class="cart-price">
            ${{ number_format($p->price ?? 0, 2) }}
        </div>
    </div>
    @endforeach

    <div class="cart-total-row">
        <div>Total</div>
        <div>${{ number_format($total, 2) }}</div>
    </div>

    <div class="checkout-bar">
        <form method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <button type="submit" class="btn-checkout">
                Purchase
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
