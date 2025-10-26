<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LibraryEntry;

class LibraryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $games = LibraryEntry::where('owner_id', $user->user_id)
            ->with('product')
            ->get();

        return view('library', [
            'games' => $games,
        ]);
    }

    public function add($product_id)
    {
        $user = Auth::user();

        // check if already owned
        $exists = LibraryEntry::where('owner_id', $user->user_id)
            ->where('game_id', $product_id)
            ->exists();

        if (!$exists) {
            LibraryEntry::create([
                'owner_id' => $user->user_id,
                'game_id' => $product_id,
                'game_icon' => null, // you can fill later
            ]);
        }

        return redirect()->back();
    }
}
