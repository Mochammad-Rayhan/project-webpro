<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $products = Produk::latest()->take(3)->get(); // best seller
        $produkTerbaru = Produk::latest()->take(4)->get(); // terbaru (biar gak kepenuhan)

        return view('frontend.v_layouts.home', compact('products', 'produkTerbaru'));
    }
}