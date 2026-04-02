<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $products = Produk::orderBy('updated_at', 'desc')->take(3)->get();
        return view('frontend.v_layouts.home', compact('products'));
    }

    // public function producthome()
    // {
    //     $productshome = Produk::orderBy('updated_at', 'desc')->take(4)->get();
    //     return view('frontend.v_layouts.home', compact('productshome'));
    // }
}
