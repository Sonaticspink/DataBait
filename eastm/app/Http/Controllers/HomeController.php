<?php


namespace App\Http\Controllers;


use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::where('price', '>', 0)->take(6)->get();   // or use a “featured” flag if you have one
        $recommended = Product::orderBy('release_date', 'desc')->take(8)->get();

        return view('home', compact('featured', 'recommended'));
    }
}
