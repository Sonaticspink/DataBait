<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $items = Wishlist::where('user_id', $user->user_id)
            ->with('product')
            ->get();

        return view('wishlist', [
            'items' => $items,
        ]);
    }

    public function add($product_id)
    {
        $user = Auth::user();

        // check if already exists
        $exists = Wishlist::where('user_id', $user->user_id)
            ->where('product_id', $product_id)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => $user->user_id,
                'product_id' => $product_id,
                'added_at' => now(),
            ]);
        }

        return redirect()->back();
    }

    public function remove($product_id)
    {
        $user = Auth::user();

        Wishlist::where('user_id', $user->user_id)
            ->where('product_id', $product_id)
            ->delete();

        return redirect()->back();
    }
}
