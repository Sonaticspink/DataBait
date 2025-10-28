<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Step 1: find all products the user already owns
        $ownedProductIds = DB::table('library')
            ->where('owner_id', $userId)
            ->pluck('game_id'); // game_id in library = product_id in products

        // Step 2: delete those products from the wishlist, so wishlist never shows owned games
        Wishlist::where('user_id', $userId)
            ->whereIn('product_id', $ownedProductIds)
            ->delete();

        // Step 3: now load wishlist items as usual
        $items = Wishlist::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('wishlist', compact('items'));
    }

    public function add($product_id)
    {
        $userId = Auth::id();

        // 1. If already owned, don't wishlist
        $alreadyOwned = DB::table('library')
            ->where('owner_id', $userId)
            ->where('game_id', $product_id)
            ->exists();

        if ($alreadyOwned) {
            return back()->with('owned', true);
        }

        // 2. If already in wishlist, do nothing extra
        $inWishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $product_id)
            ->exists();

        if (!$inWishlist) {
            Wishlist::create([
                'user_id'    => $userId,
                'product_id' => $product_id,
                'added_at'   => now(),
            ]);
        }

        return back()->with('wishlisted', true);
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
