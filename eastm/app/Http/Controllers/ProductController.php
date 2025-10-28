<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;


class ProductController extends Controller
{
    // show one product
    public function show($id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();

        $userId = Auth::id();

        // default false for guests
        $alreadyOwned = false;
        $alreadyInCart = false;
        $alreadyWishlisted = false;

        if ($userId) {
            $alreadyOwned = DB::table('library')
                ->where('owner_id', $userId)
                ->where('game_id', $product->product_id)
                ->exists();

            $alreadyInCart = Cart::where('user_id', $userId)
                ->where('product_id', $product->product_id)
                ->exists();

            $alreadyWishlisted = Wishlist::where('user_id', $userId)
                ->where('product_id', $product->product_id)
                ->exists();
        }

        // If we just came back from adding to cart or wishlist,
        // respect that (forces disabled state even if just added)
        $addedToCartNow   = session('addedToCart', false);
        $wishlistedNow    = session('wishlisted', false);
        $ownedNow         = session('owned', false);

        // These values will drive button disabled logic in Blade
        return view('products.show', [
            'product'            => $product,
            'alreadyOwned'       => $alreadyOwned || $ownedNow,
            'alreadyInCart'      => $alreadyInCart || $addedToCartNow,
            'alreadyWishlisted'  => $alreadyWishlisted || $wishlistedNow,
        ]);
    }
}
