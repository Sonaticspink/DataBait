@extends('layouts.maets')

@section('title', 'Profile - MAETS')

@section('content')
<style>
    /* Profile Header */
    .profile-header {
        background: linear-gradient(90deg, #2e2e2e, #1c1c1c);
        padding: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        margin-top: 40px;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    .profile-header img {
        width: 120px;
        height: 120px;
        border-radius: 5px;
        margin-right: 30px;
        border: 2px solid #555;
    }
    .profile-header h2 {
        color: #fff;
        margin-bottom: 5px;
    }
    .profile-header p {
        color: #bbb;
        margin: 0;
    }

    /* Details Section */
    .profile-details {
        margin-top: 40px;
    }
    .detail-card {
        background: rgba(30, 30, 30, 0.85);
        border: 1px solid #555;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .detail-card h4 {
        color: #979797ff;
        margin-bottom: 10px;
    }
    .detail-card p {
        color: #ccc;
    }
</style>

<!-- 🌟 Profile Section -->
<div class="container">
    <div class="profile-header">
        <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('img/Meat.png') }}" alt="Profile Picture">
        <div>
            <h2>{{ Auth::user()->username }}</h2>
            <p>{{ Auth::user()->email }}</p>
        </div>
    </div>

    <div class="profile-details">
        <div class="detail-card">
            <h4>Account Info</h4>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Member Since:</strong> {{ Auth::user()->registration_date ?? 'N/A' }}</p>
        </div>

        <div class="detail-card">
            <h4>Game Library</h4>
            @if($gameCount > 0)
            <p>You currently have <strong>{{ $gameCount }}</strong> game{{ $gameCount > 1 ? 's' : '' }} in your library.</p>
            @else
            <p>You currently have no games in your library.</p>
            @endif
        </div>

        <div class="detail-card">
            <h4>Wishlist</h4>
            @if($wishlistCount > 0)
            <p>You currently have <strong>{{ $wishlistCount }}</strong> game{{ $wishlistCount > 1 ? 's' : '' }} in your wishlist.</p>
            @else
            <p>Your wishlist is empty. Browse the store to add games!</p>
            @endif
        </div>
    </div>
</div>
@endsection
