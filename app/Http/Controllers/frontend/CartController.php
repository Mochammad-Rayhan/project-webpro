<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Config;
use Midtrans\Snap;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "name" => $request->name,
                "price" => $request->price,
                "image" => $request->image,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    public function getCart()
    {
        return response()->json(session('cart', []));
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $action = $request->action; // plus / minus

        if (isset($cart[$id])) {

            if ($action == 'plus') {
                $cart[$id]['qty']++;
            } else if ($action == 'minus') {
                $cart[$id]['qty']--;

                // kalau qty 0 → hapus
                if ($cart[$id]['qty'] <= 0) {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        // CONFIG MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $cart = session('cart', []);
        $user = auth()->user();

        $items = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $items[] = [
                'id' => $id,
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'name' => $item['name'],
            ];

            $total += $item['price'] * $item['qty'];
        }

        $orderId = 'ORDER-' . rand();
        transaction::create([
            'order_id' => $orderId,
            'id_admin' => $user->id_admin,
            'total' => $total,
            'status' => 'pending',
        ]);

        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->nama,
                'email' => $user->email,
                'phone' => $user->no_hp ?? '08123456789'
            ],
            'item_details' => $items
        ];

        $snapToken = Snap::getSnapToken($transaction);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }

    // public function getCart()
    // {
    //     $cart = session('cart', []);
    //     return view('frontend.cart_sidebar', compact('cart'));
    // }

    public function callback(Request $request)
    {
        $notif = new Notification();
        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        $data = Transaction::where('order_id', $order_id)->first();

        if (!$data) return;
        if ($transaction == 'settlement') {
            $data->status = 'success';
            // 🔥 HAPUS CART
            session()->forget('cart');
        } elseif ($transaction == 'pending') {
            $data->status = 'pending';
        } else {
            $data->status = 'failed';
        }
        $data->save();
    }
}
