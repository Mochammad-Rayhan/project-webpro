<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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

    public function checkout(Request $request)
    {
        // CONFIG MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $cart = session('cart', []);
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

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

        $ongkir = $request->ongkir ?? 0;
        if ($ongkir > 0) {
            $items[] = [
                'id' => 'ONGKIR',
                'price' => $ongkir,
                'quantity' => 1,
                'name' => 'Biaya Pengiriman',
            ];
        }
        $grandTotal = $total + $ongkir;

        $orderId = 'ORDER-' . rand();
        $transaction = Transaction::create([
            'order_id' => $orderId,
            'id_admin' => $user->id_admin,
            'total' => $grandTotal,
            'status' => 'pending',
            'alamat' => $request->alamat,
            'province' => $request->province,
            'city' => $request->city,
            'courier' => $request->courier,
        ]);

        foreach ($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        // (opsional tapi bagus) simpan ongkir juga
        if ($ongkir > 0) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_name' => 'Biaya Pengiriman',
                'price' => $ongkir,
                'qty' => 1,
                'subtotal' => $ongkir,
            ]);
        }

        $payload = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grandTotal,
            ],
            'customer_details' => [
                'first_name' => $user->nama,
                'email' => $user->email,
                'phone' => $user->no_hp ?? '08123456789'
            ],
            'item_details' => $items
        ];

        $snapToken = Snap::getSnapToken($payload);

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

    public function success($order_id)
    {
        $transaction = Transaction::with('details')
            ->where('order_id', $order_id)
            ->firstOrFail();

        return view('frontend.success', compact('transaction'));
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        $data = $response->json()['data'] ?? [];

        $result = array_map(function($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name']
            ];
        }, $data);

        return response()->json($result);
    }

    public function getCities($province_id)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/city/' . $province_id);

        // DEBUG
        if (!$response->successful()) {
            return response()->json([
                'error' => 'API gagal',
                'status' => $response->status(),
                'body' => $response->body()
            ], 500);
        }
        $data = $response->json()['data'] ?? [];
        $result = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
            ];
        }, $data);

        return response()->json($result);
    }   

    public function cekOngkir(Request $request)
    {
        try {
            $response = Http::asForm()->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->post('https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost', [
                'origin' => 502,
                'destination' => $request->city,
                'weight' => 1000,
                'courier' => $request->courier
            ]);
            
            $result = $response->json();
            // 🔥 DEBUG JIKA ERROR
            if ($response->failed()) {
                return response()->json([
                    'error' => 'API gagal',
                    'detail' => $result
                ], 500);
            }

            return response()->json($result['data']);

            // 🔥 HANDLE ERROR DARI API
            if ($response->failed()) {
                return response()->json([
                    'error' => 'Gagal ambil ongkir',
                    'detail' => $result
                ], 500);
            }

            if (!isset($result['rajaongkir']['results'][0]['costs'])) {
                return response()->json([
                    'error' => 'Data ongkir tidak ditemukan',
                    'response' => $result
                ], 500);
            }


        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Exception: ' . $e->getMessage()
            ], 500);
        }
    }
}
