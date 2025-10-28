@extends('layouts.maets')

@section('title', ($product->title ?? 'Game') . ' - MAETS')

@section('content')
<style>
    .product-page-shell {
        background: radial-gradient(circle at 20% 0%, rgba(50,80,120,0.4) 0%, rgba(0,0,0,0) 70%),
        linear-gradient(to bottom, #1a1e24 0%, #0f1318 100%);
        padding: 1.5rem 0 3rem;
        color: #cfd3dc;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    .breadcrumb {
        font-size: .8rem;
        color: #8b949e;
        margin-bottom: 1rem;
    }
    .breadcrumb a {
        color: #66c0f4;
        text-decoration: none;
    }
    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .page-header-title {
        color: #fff;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: .75rem;
    }

    .top-block {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(30,33,38,0.9);
        border-radius: 6px;
        padding: 1rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.6);
    }

    .media-col {
        flex: 2;
        min-width: 420px;
    }

    .fake-video {
        width: 100%;
        height: 240px;
        background: #000;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.15);
        color: #777;
        font-size: .9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .75rem;
    }

    .thumb-row {
        display: flex;
        gap: .5rem;
        overflow-x: auto;
    }
    .thumb-tile {
        width: 90px;
        height: 50px;
        border-radius: 4px;
        background-color: #0e1116;
        border: 1px solid rgba(255,255,255,0.1);
        color: #777;
        font-size: .7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        object-fit: cover;
        flex-shrink: 0;
        overflow: hidden;
    }
    .thumb-tile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .side-col {
        flex: 1.2;
        min-width: 280px;
        display: flex;
        flex-direction: column;
        background: rgba(32,35,40,0.7);
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.07);
        overflow: hidden;
    }

    .side-cover {
        width: 100%;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        background-color: #1a1d22;
        text-align: center;
        padding: .75rem;
    }
    .side-cover img {
        width: 100%;
        max-height: 180px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.15);
    }

    .side-desc {
        padding: .9rem;
        font-size: .8rem;
        color: #cfd3dc;
        line-height: 1.4;
        background-color: #2a2f37;
    }

    .side-meta {
        font-size: .75rem;
        line-height: 1.4;
        padding: .9rem;
        background-color: #2a2f37;
        border-top: 1px solid rgba(255,255,255,0.07);
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .meta-row {
        display: flex;
        font-size: .75rem;
        color: #8b949e;
        margin-bottom: .35rem;
        flex-wrap: wrap;
    }
    .meta-row .label {
        min-width: 90px;
        color: #8b949e;
    }
    .meta-row .value {
        color: #fff;
    }

    /* BUY AREA */
    .buy-area {
        margin-top: 1rem;
        padding: 1rem;
        background-color: #252a31;
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 4px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1rem;
    }
    .buy-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        flex: 1;
        min-width: 200px;
    }
    .buy-price {
        color: #66c0f4;
        font-weight: 700;
        font-size: 1rem;
    }

    .buy-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .btn-addcart {
        background: linear-gradient(#3cb85c, #2e8b46);
        border: 0;
        color: #fff;
        font-weight: 600;
        padding: .6rem 1rem;
        border-radius: .3rem;
        font-size: .8rem;
        letter-spacing: .03em;
        min-width: 130px;
        white-space: nowrap;
    }
    .btn-addcart:hover {
        background: linear-gradient(#47ca67, #35954e);
    }

    .btn-wishlist {
        background: transparent;
        border: 1px solid #66c0f4;
        color: #66c0f4;
        font-weight: 600;
        padding: .6rem 1rem;
        border-radius: .3rem;
        font-size: .8rem;
        letter-spacing: .03em;
        min-width: 130px;
        white-space: nowrap;
    }
    .btn-wishlist:hover {
        background: rgba(102,192,244,0.12);
    }

    /* LOWER PANELS */
    .feature-blocks-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .feature-panel {
        flex: 1 1 400px;
        background-color: #2a2f37;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 4px;
        box-shadow: 0 0 8px rgba(0,0,0,0.6);
        min-height: 160px;
    }

    .feature-head {
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: .75rem .9rem;
        font-size: .75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #fff;
        letter-spacing: .05em;
    }

    .feature-body {
        padding: .9rem;
        font-size: .8rem;
        color: #cfd3dc;
        line-height: 1.4;
    }

    .tag-row {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .tag-chip {
        background: #2b313b;
        color: #cfd3dc;
        border-radius: 4px;
        padding: .4rem .6rem;
        font-size: .75rem;
        border: 1px solid rgba(255,255,255,0.1);
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .media-col { min-width: 100%; }
        .side-col  { min-width: 100%; }
        .top-block { flex-direction: column; }
    }
</style>

<div class="container product-page-shell">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('home') }}">STORE</a> >
        <a href="#">All Games</a> >
        <span>{{ $product->title }}</span>
    </div>

    {{-- Title --}}
    <div class="page-header-title">
        {{ $product->title }}
    </div>

    {{-- Top section --}}
    <div class="top-block">

        {{-- LEFT: media --}}
        <div class="media-col">
            {{-- 🎥 Trailer --}}
            <div class="video-wrapper" style="position:relative;width:100%;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:6px;border:1px solid rgba(255,255,255,0.1);margin-bottom:.75rem;">
                {{-- Custom thumbnail overlay --}}
                <div class="custom-thumb"
                     style="position:absolute;top:0;left:0;width:100%;height:100%;background:url('{{ asset($product->cover_image) }}') center/cover no-repeat;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:0.3s;">
                    <div style="background:rgba(0,0,0,0.6);padding:1rem 1.5rem;border-radius:8px;text-align:center;">
                        <h5 style="color:#fff;margin-bottom:.5rem;font-weight:700;">{{ $product->title }}</h5>
                        <p style="color:#ccc;margin-bottom:.5rem;font-size:.85rem;">Official Launch Trailer</p>
                        <span style="font-size:2rem;color:#66c0f4;"><i class="bi bi-play-circle-fill"></i></span>
                    </div>
                </div>

                {{-- Hidden iframe until clicked --}}
                <iframe id="yt-player" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                        style="position:absolute;top:0;left:0;width:100%;height:100%;border-radius:6px;display:none;"></iframe>
            </div>

            {{-- Add a little script to swap thumbnail → video --}}
            <script>
                document.querySelector('.custom-thumb').addEventListener('click', function() {
                    this.style.display = 'none';
                    const iframe = document.getElementById('yt-player');
                    iframe.src = "https://www.youtube.com/embed/xvFZjo5PgG0?autoplay=1";
                    iframe.style.display = 'block';
                });
            </script>

            {{-- Screenshot thumbnails: show cover_image + placeholders --}}
            <div class="thumb-row">
                @if ($product->cover_image)
                <div class="thumb-tile">
                    <img src="{{ asset($product->cover_image) }}" alt="cover">
                </div>
                @endif
                <div class="thumb-tile">
                    <img src="{{ asset($product->cover_image) }}" alt="preview 1"
                         style="filter:grayscale(60%) brightness(0.9);">
                </div>
                <div class="thumb-tile">
                    <img src="{{ asset($product->cover_image) }}" alt="preview 2"
                         style="filter:blur(1px) brightness(1.1) contrast(0.1);">
                </div>
                <div class="thumb-tile">
                    <img src="{{ asset($product->cover_image) }}" alt="preview 3"
                         style="filter:hue-rotate(30deg) saturate(2);">
                </div>
            </div>
        </div>

        {{-- RIGHT: info panel --}}
        <div class="side-col">

            {{-- cover image --}}
            <div class="side-cover">
                @if ($product->cover_image)
                <img src="{{ asset($product->cover_image) }}" alt="{{ $product->title }}">
                @else
                <div class="text-muted" style="font-size:.8rem;">No cover</div>
                @endif
            </div>

            {{-- short desc --}}
            <div class="side-desc">
                @if (!empty($product->description))
                {{ Str::limit($product->description, 260) }}
                @else
                No description available.
                @endif
            </div>

            {{-- meta info --}}
            <div class="side-meta">
                <div class="meta-row">
                    <div class="label">Release Date:</div>
                    <div class="value">{{ $product->release_date ?? '-' }}</div>
                </div>

                <div class="meta-row">
                    <div class="label">Developer:</div>
                    <div class="value">{{ $product->developer ?? '-' }}</div>
                </div>

                <div class="meta-row">
                    <div class="label">Publisher:</div>
                    <div class="value">{{ $product->publisher ?? '-' }}</div>
                </div>

                <div class="meta-row">
                    <div class="label">Genres:</div>
                    <div class="value">{{ $product->product_genres ?? '-' }}</div>
                </div>
            </div>

            {{-- purchase / wishlist box --}}
            <div class="buy-area">
                <div class="buy-title">Buy {{ $product->title }}</div>

                <div class="buy-price">
                    ฿{{ number_format($product->price ?? 0, 2) }}
                </div>

                <div class="buy-buttons">

                    {{-- If owned: show one disabled pill and stop --}}
                    @if ($alreadyOwned)
                    <button class="btn-addcart"
                            disabled
                            style="opacity:0.6; cursor:not-allowed;"
                            title="You already own this game">
                        ✔ In Library
                    </button>
                    @else
                    {{-- Add to Cart button (disable if alreadyInCart) --}}
                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="btn-addcart"
                                @if ($alreadyInCart) disabled style="opacity:0.6; cursor:not-allowed;" title="Already in cart" @endif>
                            @if ($alreadyInCart)
                            In Cart
                            @else
                            Add to Cart
                            @endif
                        </button>
                    </form>

                    {{-- Add to Wishlist button (disable if alreadyWishlisted) --}}
                    <form action="{{ route('wishlist.add', $product->product_id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="btn-wishlist"
                                @if ($alreadyWishlisted) disabled style="opacity:0.4; cursor:not-allowed;" title="Already in wishlist" @endif>
                            @if ($alreadyWishlisted)
                            In Wishlist
                            @else
                            + Wishlist
                            @endif
                        </button>
                    </form>
                    @endif

                </div>
            </div>

        </div>
    </div>

    {{-- Lower info panels --}}
    <div class="feature-blocks-wrap">

        {{-- About This Game --}}
        <div class="feature-panel" style="flex:1 1 600px; min-width: 600px;">
            <div class="feature-head">About This Game</div>
            <div class="feature-body">
                @if (!empty($product->description))
                {{ $product->description }}
                @else
                No additional description provided for this title.
                @endif
            </div>
        </div>

        {{-- Tags / Features (static for now) --}}
        <div class="feature-panel" style="flex:0 0 280px; max-width: 320px;">
            <div class="feature-head">Popular tags for this product</div>
            <div class="feature-body">
                <div class="tag-row">
                    <div class="tag-chip">Single-player</div>
                    <div class="tag-chip">Controller Support</div>
                    <div class="tag-chip">Story Rich</div>
                    <div class="tag-chip">Action</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
