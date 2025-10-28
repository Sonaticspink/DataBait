@extends('layouts.maets')

@section('title', 'Home - MAETS')

@section('content')
<style>
    body {
        color: #fff;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    /* Hero Banner */
    .hero-banner {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 12px rgba(0,0,0,0.5);
    }
    .hero-banner img {
        width: 100%;
        height: 360px;
        object-fit: cover;
        opacity: 0.9;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.9) 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
    }
    .hero-overlay h1 {
        font-size: 2.5rem;
        font-weight: 800;
        text-shadow: 0 0 10px rgba(0,0,0,0.8);
    }
    .hero-overlay p {
        color: #ccc;
        margin-top: 0.5rem;
    }

    /* Section titles */
    h2.section-title {
        font-weight: 700;
        color: #fff;
        border-left: 4px solid #66c0f4;
        padding-left: 0.75rem;
        margin-bottom: 1.25rem;
    }

    /* Featured Grid */
    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .featured-card {
        background: rgba(25, 28, 33, 0.9);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .featured-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.6);
        border-color: #66c0f4;
    }
    .featured-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .featured-info {
        padding: 1rem;
    }
    .featured-info h3 {
        color: #fff;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }
    .featured-info p {
        color: #aaa;
        font-size: 0.9rem;
    }

    /* Trending grid */
    .trending-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }
    .trending-item {
        background: rgba(30, 33, 38, 0.9);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 6px;
        overflow: hidden;
        text-decoration: none;
        color: #fff;
        transition: transform 0.2s, border-color 0.2s;
    }
    .trending-item:hover {
        transform: scale(1.05);
        border-color: #66c0f4;
    }
    .trending-item img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    .trending-info {
        padding: 0.75rem;
    }
    .trending-info .title {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    .trending-info .price {
        color: #66c0f4;
        font-weight: 500;
        font-size: 0.85rem;
    }

    /* Container padding */
    .content-wrap {
        padding: 2rem 0;
    }
</style>

<div class="container content-wrap">
    <!-- 🌟 Hero Banner -->
    <div class="hero-banner mb-5">
        <img src="https://clan.fastly.steamstatic.com/images/44977790/73192d07ec4c638c7fbee1ffb774d9c4b5eb5229_960x311.png" alt="Hero Banner">
        <div class="hero-overlay">
            <h1>Publisher Sale</h1>
            <p>Get the best deals this week</p>
        </div>
    </div>

    <!-- 🌟 Featured Section -->
    <section class="mb-5">
        <h2 class="section-title">Featured & Recommended</h2>
        <div class="featured-grid">
            @foreach($featured as $game)
            <a href="{{ route('product.show', $game->product_id) }}" class="featured-card text-decoration-none">
                <img src="{{ asset($game->cover_image) }}" alt="{{ $game->title }}">
                <div class="featured-info">
                    <h3>{{ $game->title }}</h3>
                    <p>{{ Str::limit($game->description, 80) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- 🌟 Trending Section -->
    <section>
        <h2 class="section-title">New & Trending</h2>
        <div class="trending-grid">
            @foreach($recommended as $g)
            <a href="{{ route('product.show', $g->product_id) }}" class="trending-item">
                <img src="{{ asset($g->cover_image) }}" alt="{{ $g->title }}">
                <div class="trending-info">
                    <div class="title">{{ $g->title }}</div>
                    <div class="price">฿{{ number_format($g->price, 2) }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
