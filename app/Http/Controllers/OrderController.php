<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function riwayat()
    {
        $orders = Transaction::where('id_admin', Auth::id())
                    ->latest()
                    ->paginate(6);

        return view('frontend.riwayat', [
            'orders' => $orders
        ]);
    }
}