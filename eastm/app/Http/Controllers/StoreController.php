<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // also load wishlist ids and owned ids for current user to show buttons state
        $user = Auth::user();

        $wishlistProductIds = $user
            ? $user->wishlistItems()->pluck('product_id')->toArray()
            : [];

        $ownedProductIds = $user
            ? $user->libraryEntries()->pluck('game_id')->toArray()
            : [];

        return view('store', [
            'products' => $products,
            'wishlistProductIds' => $wishlistProductIds,
            'ownedProductIds' => $ownedProductIds,
        ]);
    }
}
