@extends('layouts.maets')

@section('title', 'Your Library - MAETS')

@section('content')
<style>
    .library-shell {
        height: calc(100vh - 64px);
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
    .game-list { flex: 1; overflow-y: auto; }
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
    .game-meta { line-height: 1.2; }
    .game-title { color: #fff; font-weight: 500; font-size: .9rem; }
    .game-genre { color: #8b949e; font-size: .7rem; }

    /* RIGHT MAIN COLUMN */
    .library-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background-color: #0f141a;
    }

    /* HERO SECTION */
    .hero-area {
        position: relative;
        background: radial-gradient(circle at 20% 20%, rgba(40,90,200,0.4) 0%, rgba(0,0,0,0) 70%);
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: 1rem 1rem 1.25rem;
        display: flex;
        flex-wrap: wrap;
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
        line-height: 1.4;
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
        gap: .75rem;
        flex-wrap: wrap;
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
    .btn-play-steam:disabled { opacity: .5; }
    .btn-outline-steam {
        background: transparent;
        color: #fff;
        border: 1px solid rgba(255,255,255,0.4);
        font-size: .8rem;
        padding: .5rem .9rem;
        border-radius: .3rem;
    }

    /* INFO + SIDEPANEL ROW 1 */
    .details-wrap {
        display: flex;
        flex-wrap: wrap;
        padding: 1rem;
        gap: 1rem;
    }
    .panel-about,
    .panel-info {
        background-color: #1a1f27;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 4px;
        color: #b6bcc7;
    }
    .panel-about {
        flex: 1 1 600px;
        min-height: 180px;
        font-size: .85rem;
        display: flex;
        flex-direction: column;
    }
    .panel-info {
        flex: 0 0 280px;
        max-width: 280px;
        font-size: .8rem;
        display: flex;
        flex-direction: column;
        min-height: 180px;
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
    .panel-row:last-child { border-bottom: 0; }
    .panel-row span.value { color: #fff; }
    .panel-row span.value.ok { color: #4caf50; font-weight: 500; }

    /* === NEW: FRIENDS / ACHIEVEMENTS / SCREENSHOTS / ACTIVITY === */
    .social-wrap {
        display: flex;
        flex-wrap: wrap;
        padding: 0 1rem 1rem;
        gap: 1rem;
    }

    .panel-wide {
        background-color: #2a2f37;
        background-image: linear-gradient(#2a2f37, #2a2f37 60%, #242a31 100%);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 4px;
        flex: 1 1 600px;
        min-width: 600px;
        color: #cfd3dc;
        box-shadow: 0 0 8px rgba(0,0,0,0.6);
    }

    .panel-activity {
        background-color: #2a2f37;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 4px;
        flex: 0 0 320px;
        max-width: 320px;
        color: #cfd3dc;
        display: flex;
        flex-direction: column;
        box-shadow: 0 0 8px rgba(0,0,0,0.6);
    }

    .sub-head-row {
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: .75rem .9rem;
        font-size: .75rem;
        font-weight: 600;
        color: #cfd3dc;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .friends-row,
    .ach-row,
    .shots-row {
        padding: .9rem;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .5rem 1rem;
        font-size: .8rem;
    }
    .shots-row { border-bottom: 0; }

    .friend-avatar {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        border: 1px solid #000;
        object-fit: cover;
    }

    .achievements-grid {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }
    .ach-box {
        width: 48px;
        height: 48px;
        background-color: #0e1116;
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .7rem;
        color: #999;
        overflow: hidden;
    }
    .ach-count-badge {
        font-size: .75rem;
        color: #fff;
        background-color: #3b3f45;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 4px;
        padding: .5rem .75rem;
        min-width: 48px;
        text-align: center;
        font-weight: 500;
    }

    .shot-thumb {
        width: 96px;
        height: 54px;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.1);
        background-color: #0e1116;
        object-fit: cover;
        font-size: .7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #777;
        overflow: hidden;
    }

    .activity-head {
        color: #9dd08a;
        font-size: .8rem;
        font-weight: 600;
        padding: .75rem .9rem .25rem;
    }
    .activity-entry {
        border-top: 1px solid rgba(255,255,255,0.07);
        padding: .75rem .9rem;
        background-color: #373e45;
        background-image: linear-gradient(#3a4047, #2f353b);
        color: #cfd3dc;
        font-size: .8rem;
    }
    .activity-entry + .activity-entry {
        margin-top: .5rem;
    }
    .activity-date {
        color: #9bb2c7;
        font-size: .7rem;
        margin-bottom: .25rem;
    }
    .activity-title {
        color: #cfd3dc;
        font-weight: 600;
        font-size: .8rem;
        margin-bottom: .25rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .activity-body {
        color: #cfd3dc;
        font-size: .8rem;
    }

    @media (max-width: 768px) {
        .library-shell { flex-direction: column; height: auto; }
        .library-sidebar {
            width: 100%;
            max-height: 200px;
            border-right: 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .hero-area { flex-direction: column; }
        .hero-cover { width: 100%; max-width: 320px; }
        .panel-info { flex: 1 1 auto; max-width: 100%; }
        .panel-wide,
        .panel-activity {
            flex: 1 1 100%;
            max-width: 100%;
            min-width: 100%;
        }
    }
</style>

<div class="library-shell">
    {{-- LEFT SIDEBAR --}}
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
                @if ($p && $p->cover_image)
                <img src="{{ asset($p->cover_image) }}" class="game-thumb" alt="cover">
                @else
                <div class="game-thumb"><span class="text-muted">No<br>Img</span></div>
                @endif

                <div class="game-meta">
                    <div class="game-title">{{ $p->title ?? 'Unknown Game' }}</div>
                    <div class="game-genre">{{ $p->product_genres ?? '—' }}</div>
                </div>
            </a>
            @empty
            <div class="text-center text-muted p-3 small">You don’t own any games yet.</div>
            @endforelse
        </div>
    </aside>

    {{-- RIGHT MAIN PANEL --}}
    <main class="library-main">

        {{-- HERO SECTION --}}
        <section class="hero-area">
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

            <div class="hero-info">
                <div class="hero-title">{{ $selectedProduct->title ?? 'Select a game' }}</div>

                <div class="hero-genres mb-2">
                    {{ $selectedProduct->product_genres ?? '' }}
                </div>

                <div class="hero-meta mb-2">
                    @if ($selectedProduct)
                    <div>Developer: <span class="text-light">{{ $selectedProduct->developer ?? '—' }}</span></div>
                    <div>Publisher: <span class="text-light">{{ $selectedProduct->publisher ?? '—' }}</span></div>
                    <div>Release: <span class="text-light">{{ $selectedProduct->release_date ?? '—' }}</span></div>
                    @else
                    No game selected.
                    @endif
                </div>

                <div class="hero-actions">
                    <button class="btn-play-steam" @if(!$selectedProduct) disabled @endif>▶ PLAY</button>
                </div>
            </div>
        </section>

        {{-- ROW 1: ABOUT + GAME INFO --}}
        <section class="details-wrap">
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

        {{-- ROW 2: FRIENDS / ACHIEVEMENTS / SCREENSHOTS / ACTIVITY --}}
        <section class="social-wrap">
            {{-- LEFT BIG COLUMN --}}
            <div class="panel-wide">

                {{-- Friends who play --}}
                <div class="sub-head-row">
                    <span>Friends who play this game</span>
                    <span style="font-size:.7rem;color:#9bb2c7;">Recently</span>
                </div>
                <div class="friends-row">
                    {{-- fake avatars / usernames --}}
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('img/friend1.jpg') }}" class="friend-avatar" alt="f1">
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('img/friend2.jpg') }}" class="friend-avatar" alt="f2">
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('img/friend3.jpg') }}" class="friend-avatar" alt="f3">
                    </div>
                </div>

                {{-- Achievements --}}
                <div class="sub-head-row">
                    <span>Most Valuable Achievements</span>
                    <span style="font-size:.7rem;color:#9bb2c7;">19 / 65</span>
                </div>
                <div class="ach-row">
                    <div class="achievements-grid">
                        <div class="ach-box">
                            <img src="{{ asset('img/ach1.jpg') }}" alt="ach1" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="ach-box">
                            <img src="{{ asset('img/ach2.jpg') }}" alt="ach2" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="ach-box">
                            <img src="{{ asset('img/ach3.jpg') }}" alt="ach3" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="ach-count-badge">+16</div>
                    </div>
                </div>

                {{-- Screenshots --}}
                <div class="sub-head-row">
                    <span>Most Valuable Screenshots</span>
                </div>
                <div class="shots-row">
                    <div class="shot-thumb">
                        <img src="{{ asset('img/shot1.png') }}" alt="shot1" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div class="shot-thumb">
                        <img src="{{ asset('img/shot2.jpg') }}" alt="shot2" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div class="shot-thumb">
                        <img src="{{ asset('img/shot3.jpeg') }}" alt="shot3" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div class="shot-thumb">
                        <span class="text-white">+12</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT ACTIVITY SIDEBAR --}}
            <div class="panel-activity">
                <div class="activity-head">Activity</div>

                <div class="activity-entry">
                    <div class="activity-date">Oct 13</div>
                    <div class="activity-title">
                        <span style="color:#9dd08a;">Small Update</span>
                    </div>
                    <div class="activity-body">
                        It's just a small but noteworthy update—
                    </div>
                </div>

                <div class="activity-entry">
                    <div class="activity-date">Oct 12</div>
                    <div class="activity-title">
                        <span style="color:#9dd08a;">Big Update</span>
                    </div>
                    <div class="activity-body">
                        Wow here's a BIG update!
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection
