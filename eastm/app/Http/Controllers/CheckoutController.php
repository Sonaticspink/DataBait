<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\LibraryEntry;
use App\Models\Wishlist;
use App\Models\Product;

class CheckoutController extends Controller
{
    // GET /checkout
    public function index()
    {
        return view('checkout');
    }

    // POST /checkout/confirm
    public function confirm()
    {
        $user = Auth::user();

        return DB::transaction(function () use ($user) {
            // 1. get items in cart
            $cartItems = Cart::where('user_id', $user->user_id)
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                // nothing to buy -> go back cart
                return redirect()->route('cart');
            }

            // 2. total price
            $total = $cartItems->sum(function ($row) {
                return $row->product?->price ?? 0;
            });

            // 3. create order
            $order = Order::create([
                'user_id'      => $user->user_id,
                'total_price'  => $total,
                'ordered_at'   => now(),
            ]);

            // 4. create order_items + push to library
            foreach ($cartItems as $item) {
                $prod = $item->product;
                if (!$prod) continue;

                // order_items row
                OrderItem::create([
                    'order_id'          => $order->order_id,
                    'product_id'        => $prod->product_id,
                    'price_at_purchase' => $prod->price ?? 0,
                ]);

                // add to library (if not already there)
                $alreadyOwned = LibraryEntry::where('owner_id', $user->user_id)
                    ->where('game_id', $prod->product_id)
                    ->exists();

                if (!$alreadyOwned) {
                    LibraryEntry::create([
                        'owner_id'  => $user->user_id,
                        'game_id'   => $prod->product_id,
                        'game_icon' => null,
                    ]);
                }
            }

            // 5. clear cart
            Cart::where('user_id', $user->user_id)->delete();

            // 6. send them to library view
            return redirect()->route('library');
            
        });
    }
}
