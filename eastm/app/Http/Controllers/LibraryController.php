<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LibraryEntry;

class LibraryController extends Controller
{
    public function index($product_id = null)
    {
        $user = Auth::user();

        // Load all games this user owns
        $games = LibraryEntry::where('owner_id', $user->user_id)
            ->with('product')
            ->get();

        // Which game should be shown on the right?
        $selected = null;

        if ($product_id) {
            // find the one matching the clicked product_id
            $selected = $games->first(function ($entry) use ($product_id) {
                return (string)$entry->game_id === (string)$product_id;
            });
        }

        // fallback: if no product_id in URL or invalid, use first owned game
        if (!$selected) {
            $selected = $games->first();
        }

        $selectedProduct = $selected ? $selected->product : null;

        return view('library', [
            'games'            => $games,
            'selected'         => $selected,
            'selectedProduct'  => $selectedProduct,
        ]);
    }

    public function add($product_id)
    {
        $user = Auth::user();

        // Don't duplicate same game for same user
        $exists = LibraryEntry::where('owner_id', $user->user_id)
            ->where('game_id', $product_id)
            ->exists();

        if (!$exists) {
            LibraryEntry::create([
                'owner_id'  => $user->user_id,
                'game_id'   => $product_id,
                'game_icon' => null,
            ]);
        }

        // After adding, go straight to /library/{product_id} so it opens that game
        return redirect()->route('library', ['product_id' => $product_id]);
    }
}
