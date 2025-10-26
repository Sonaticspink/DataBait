<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LibraryEntry;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $gameCount = \App\Models\LibraryEntry::where('owner_id', $user->user_id)->count();
        $wishlistCount = Wishlist::where('user_id', $user->user_id)->count();

        return view('dashboard', [
            'user' => $user,
            'gameCount' => $gameCount,
            'wishlistCount' => $wishlistCount,
        ]);
    }
}
