<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1b1f23;
            color: #d7d7d7;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .library-shell {
            height: calc(100vh - 64px);
            display: flex;
            gap: 0;
            color: #d7d7d7;
        }

        /* LEFT SIDEBAR */
        .library-sidebar {
            width: 260px;
            background: #1f242b;
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
            text-decoration: none;
            color: #d7d7d7;
            font-size: .9rem;
            border-left: 3px solid transparent;
        }

        .game-row:hover {
            background: radial-gradient(circle at 0% 0%, rgba(36,107,255,0.18) 0%, rgba(20,24,30,0.5) 60%);
        }

        .game-row.active {
            background: radial-gradient(circle at 0% 0%, rgba(36,107,255,0.28) 0%, rgba(20,24,30,0.6) 60%);
            border-left: 3px solid #2d6dff;
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
            line-height: 1.2;
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
            padding: 1rem 1rem 1.25rem;
            display: flex;
            gap: 1rem;
        }

        .hero-cover {
            width: 220px;
            max-width: 40%;
            border-radius: 6px;
            background-color: #1e242c;
            border: 1px solid rgba(255,255,255,0.07);
            overflow: hidden;
            flex-shrink: 0;
        }

        .hero-cover img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
        }

        .hero-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            color: #d7d7d7;
        }

        .hero-title {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .hero-genres {
            color: #8b949e;
            font-size: .8rem;
            line-height: 1.2;
        }

        .hero-meta {
            font-size: .75rem;
            color: #8b949e;
            line-height: 1.4;
        }

        .hero-actions {
            margin-top: .75rem;
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .btn-play-steam {
            background: linear-gradient(#3cb85c, #2e8b46);
            border: 0;
            color: #fff;
            font-weight: 600;
            padding: .5rem .9rem;
            border-radius: .3rem;
            text-transform: uppercase;
            font-size: .8rem;
            letter-spacing: .03em;
            min-width: 100px;
        }

        .btn-play-steam:disabled {
            opacity: .5;
        }

        .btn-outline-steam {
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.4);
            font-size: .8rem;
            padding: .5rem .9rem;
            border-radius: .3rem;
        }

        /* LOWER DETAILS SECTION */
        .details-wrap {
            display: flex;
            flex-wrap: wrap;
            padding: 1rem;
            gap: 1rem;
        }

        .panel-about {
            background-color: #1a1f27;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 4px;
            flex: 1 1 600px;
            min-height: 300px;
            color: #b6bcc7;
            font-size: .85rem;
        }

        .panel-info {
            background-color: #1a1f27;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 4px;
            flex: 0 0 280px;
            max-width: 280px;
            color: #b6bcc7;
            font-size: .8rem;
        }

        .panel-head {
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: .75rem .9rem;
            font-size: .7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #fff;
        }

        .panel-body {
            padding: .9rem;
            line-height: 1.4;
        }

        .panel-row {
            display: flex;
            justify-content: space-between;
            font-size: .75rem;
            color: #8b949e;
            padding: .5rem .9rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .panel-row:last-child {
            border-bottom: 0;
        }

        .panel-row span.value {
            color: #fff;
        }

        .panel-row span.value.ok {
            color: #4caf50;
            font-weight: 500;
        }

        /* Scrollbars */
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

        @media (max-width: 768px) {
            .library-shell {
                flex-direction: column;
                height: auto;
            }

            .library-sidebar {
                width: 100%;
                max-height: 200px;
                border-right: 0;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }

            .hero-area {
                flex-direction: column;
            }

            .hero-cover {
                width: 100%;
                max-width: 320px;
            }

            .panel-info {
                flex: 1 1 auto;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

@include('partials.navbar', ['active' => 'library'])

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
            $isActive = $selectedProduct && $p && $p->product_id === $selectedProduct->product_id;
            @endphp

            <a href="{{ route('library', ['product_id' => $p->product_id]) }}"
               class="game-row {{ $isActive ? 'active' : '' }}">
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

                {{-- title / genres --}}
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
            {{-- cover art --}}
            <div class="hero-cover">
                @if ($selectedProduct && $selectedProduct->cover_image)
                <img src="{{ asset($selectedProduct->cover_image) }}" alt="cover">
                @else
                <div class="d-flex align-items-center justify-content-center text-muted"
                     style="width:100%;height:120px;font-size:.8rem;background:#0e1116;">
                    No cover
                </div>
                @endif
            </div>

            {{-- text info --}}
            <div class="hero-info">
                <div class="hero-title">
                    {{ $selectedProduct->title ?? 'Select a game' }}
                </div>

                <div class="hero-genres mb-2">
                    {{ $selectedProduct->product_genres ?? '' }}
                </div>

                <div class="hero-meta mb-2">
                    @if ($selectedProduct)
                    <div>Developer:
                        <span class="text-light">{{ $selectedProduct->developer ?? '—' }}</span>
                    </div>
                    <div>Publisher:
                        <span class="text-light">{{ $selectedProduct->publisher ?? '—' }}</span>
                    </div>
                    <div>Release:
                        <span class="text-light">{{ $selectedProduct->release_date ?? '—' }}</span>
                    </div>
                    @else
                    No game selected.
                    @endif
                </div>

                <div class="hero-actions">
                    <button class="btn-play-steam"
                            @if(!$selectedProduct) disabled @endif>
                        ▶ PLAY
                    </button>

                    <button class="btn btn-outline-steam"
                            @if(!$selectedProduct) disabled @endif>
                        View Details
                    </button>
                </div>
            </div>
        </section>

        {{-- DETAILS SECTION --}}
        <section class="details-wrap">

            {{-- ABOUT THIS GAME --}}
            <div class="panel-about">
                <div class="panel-head">ABOUT THIS GAME</div>
                <div class="panel-body">
                    @if ($selectedProduct)
                    {{ $selectedProduct->description ?? 'No description provided.' }}
                    @else
                    Select a game on the left to view its details.
                    @endif
                </div>
            </div>

            {{-- GAME INFO SIDEBAR --}}
            <div class="panel-info">
                <div class="panel-head">GAME INFO</div>

                <div class="panel-row">
                    <span>Genres</span>
                    <span class="value">{{ $selectedProduct->product_genres ?? '—' }}</span>
                </div>

                <div class="panel-row">
                    <span>Price</span>
                    <span class="value">
                        @if ($selectedProduct && isset($selectedProduct->price))
                            ${{ number_format($selectedProduct->price, 2) }}
                        @else
                            —
                        @endif
                    </span>
                </div>

                <div class="panel-row">
                    <span>Owned by</span>
                    <span class="value">{{ Auth::user()->username }}</span>
                </div>

                <div class="panel-row">
                    <span>Status</span>
                    <span class="value ok">Installed</span>
                </div>

                <div class="panel-row">
                    <span>Play time</span>
                    <span class="value">0.0 hrs</span>
                </div>
            </div>
        </section>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
