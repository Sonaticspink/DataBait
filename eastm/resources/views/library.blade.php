<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1b1f23; /* deep dark */
            color: #d7d7d7;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .library-shell {
            height: calc(100vh - 64px); /* minus navbar height */
            display: flex;
            gap: 0;
            color: #d7d7d7;
        }

        /* LEFT SIDEBAR */
        .library-sidebar {
            width: 260px;
            background: linear-gradient(#1f242b, #1a1d22);
            border-right: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            color: #8b949e;
            letter-spacing: .05em;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .game-list {
            flex: 1;
            overflow-y: auto;
        }

        .game-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .6rem .9rem;
            cursor: pointer;
            text-decoration: none;
            color: #d7d7d7;
            font-size: .9rem;
        }

        .game-row:hover,
        .game-row.active {
            background: radial-gradient(circle at 0% 0%, rgba(36,107,255,0.18) 0%, rgba(20,24,30,0.5) 60%);
        }

        .game-thumb {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 4px;
            background-color: #0e1116;
            border: 1px solid rgba(255,255,255,0.07);
            object-fit: cover;
            font-size: .7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
        }

        .game-meta {
            line-height: 1.2;
        }

        .game-title {
            color: #fff;
            font-weight: 500;
            font-size: .9rem;
        }

        .game-genre {
            color: #8b949e;
            font-size: .7rem;
        }

        /* RIGHT PANEL */
        .library-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #0f141a;
        }

        /* HERO / HEADER AREA */
        .hero-area {
            position: relative;
            background: radial-gradient(circle at 20% 20%, rgba(40,90,200,0.4) 0%, rgba(0,0,0,0) 70%);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 1.5rem;
            display: flex;
            gap: 1.5rem;
        }

        .hero-cover {
            width: 300px;
            max-width: 40%;
            border-radius: 6px;
            background-color: #1e242c;
            border: 1px solid rgba(255,255,255,0.07);
            overflow: hidden;
            flex-shrink: 0;
        }

        .hero-cover img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            display: block;
        }

        .hero-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .hero-title {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .hero-genres {
            color: #8b949e;
            font-size: .8rem;
        }

        .hero-actions {
            margin-top: auto;
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .btn-play-steam {
            background: linear-gradient(#3cb85c, #2e8b46);
            border: 0;
            color: #fff;
            font-weight: 600;
            padding: .6rem 1rem;
            border-radius: .3rem;
            text-transform: uppercase;
            font-size: .8rem;
            letter-spacing: .03em;
            min-width: 120px;
        }

        .btn-play-steam:disabled {
            opacity: .5;
        }

        .small-info {
            font-size: .75rem;
            color: #8b949e;
        }

        /* LOWER PANEL: DETAILS / ACTIVITY */
        .details-area {
            flex: 1;
            padding: 1rem 1.5rem;
            display: grid;
            grid-template-columns: minmax(0,1fr) 320px;
            gap: 1.5rem;
            overflow-y: auto;
        }

        .panel-box {
            background-color: #1a1f27;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 6px;
            padding: 1rem 1rem 1.25rem;
        }

        .panel-title {
            color: #fff;
            font-size: .8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .75rem;
        }

        .panel-text {
            font-size: .8rem;
            color: #b6bcc7;
            line-height: 1.4;
            white-space: pre-line;
        }

        .panel-subrow {
            display: flex;
            justify-content: space-between;
            font-size: .75rem;
            color: #8b949e;
            padding: .4rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .panel-subrow:last-child {
            border-bottom: 0;
        }

        /* mini scrollbars for dark mode to feel "PC app"-ish */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: #2a313d;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-track {
            background: #11151a;
        }

        @media (max-width: 992px) {
            .details-area {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .library-shell {
                flex-direction: column;
            }
            .library-sidebar {
                width: 100%;
                max-height: 200px;
                border-right: 0;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }
        }
    </style>
</head>
<body>

@include('partials.navbar', ['active' => 'library'])

@php
    // pick first owned game as the "selected" one for hero panel
    $selected = $games->first();
    $selectedProduct = $selected?->product;
@endphp

<div class="library-shell">

    {{-- LEFT SIDEBAR LIST --}}
    <aside class="library-sidebar">
        <div class="sidebar-header">
            LIBRARY ({{ $games->count() }})
        </div>

        <div class="game-list">
            @forelse ($games as $entry)
                @php
                    $p = $entry->product;
                    $isActive = $selected && $p && $p->product_id === $selectedProduct?->product_id;
                @endphp

                <a class="game-row {{ $isActive ? 'active' : '' }}">
                    {{-- thumb --}}
                    @if ($p && $p->cover_image)
                        <img src="{{ asset($p->cover_image) }}"
                             class="game-thumb"
                             alt="cover">
                    @else
                        <div class="game-thumb">
                            <span class="text-muted">No<br>Img</span>
                        </div>
                    @endif

                    {{-- title / genre --}}
                    <div class="game-meta">
                        <div class="game-title">
                            {{ $p->title ?? 'Unknown Game' }}
                        </div>
                        <div class="game-genre">
                            {{ $p->product_genres ?? '—' }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center text-muted p-3 small">
                    You don’t own any games yet.
                </div>
            @endforelse
        </div>
    </aside>

    {{-- RIGHT MAIN PANEL --}}
    <main class="library-main">

        {{-- HERO SECTION --}}
        <section class="hero-area">
            {{-- big cover --}}
            <div class="hero-cover">
                @if ($selectedProduct && $selectedProduct->cover_image)
                    <img src="{{ asset($selectedProduct->cover_image) }}" alt="cover">
                @else
                    <div class="d-flex align-items-center justify-content-center text-muted"
                         style="width:100%;height:170px;font-size:.8rem;background:#0e1116;">
                        No cover
                    </div>
                @endif
            </div>

            {{-- info + play --}}
            <div class="hero-info">
                <div class="hero-title">
                    {{ $selectedProduct->title ?? 'Select a game' }}
                </div>

                <div class="hero-genres mb-2">
                    {{ $selectedProduct->product_genres ?? '' }}
                </div>

                <div class="small-info mb-3">
                    @if ($selectedProduct)
                        Developer:
                        <span class="text-light">{{ $selectedProduct->developer ?? '—' }}</span><br>
                        Publisher:
                        <span class="text-light">{{ $selectedProduct->publisher ?? '—' }}</span><br>
                        Release:
                        <span class="text-light">{{ $selectedProduct->release_date ?? '—' }}</span>
                    @else
                        No game selected.
                    @endif
                </div>

                <div class="hero-actions">
                    <button class="btn-play-steam"
                            @if(!$selectedProduct) disabled @endif>
                        ▶ PLAY
                    </button>

                    <button class="btn btn-outline-light btn-sm"
                            style="border-color:rgba(255,255,255,0.3);color:#fff;"
                            @if(!$selectedProduct) disabled @endif>
                        View Details
                    </button>
                </div>
            </div>
        </section>

        {{-- LOWER DETAILS / RIGHT SIDEBAR --}}
        <section class="details-area">
            {{-- left column: about game --}}
            <div class="panel-box">
                <div class="panel-title">About this game</div>
                <div class="panel-text">
@if ($selectedProduct)
{{ $selectedProduct->description ?? 'No description provided.' }}
@else
Select a game from the left sidebar to see details here.
@endif
                </div>
            </div>

            {{-- right column: game info / stats --}}
            <div class="panel-box">
                <div class="panel-title">Game info</div>

                <div class="panel-subrow">
                    <span>Genres</span>
                    <span class="text-light">{{ $selectedProduct->product_genres ?? '—' }}</span>
                </div>

                <div class="panel-subrow">
                    <span>Price</span>
                    <span class="text-light">
                        @if ($selectedProduct && isset($selectedProduct->price))
                            ${{ number_format($selectedProduct->price, 2) }}
                        @else
                            —
                        @endif
                    </span>
                </div>

                <div class="panel-subrow">
                    <span>Owned by</span>
                    <span class="text-light">{{ Auth::user()->username }}</span>
                </div>

                <div class="panel-subrow">
                    <span>Status</span>
                    <span class="text-success fw-semibold">Installed</span>
                    {{-- In future you can flip this to "Not Installed" based on your data --}}
                </div>

                <div class="panel-subrow">
                    <span>Play time</span>
                    <span class="text-light">0.0 hrs</span>
                </div>
            </div>
        </section>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
