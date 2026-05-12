<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\Produk;

Route::post('/chat-ai', function (Request $request) {

    try {

        // =========================
        // AMBIL PRODUK
        // =========================

        $products = Produk::all();

        // =========================
        // FORMAT PRODUK KE TEXT
        // =========================

        $productList = "";

        foreach ($products as $product) {

            $productList .= "

            ID: {$product->id_produk}
            Nama: {$product->nama_produk}
            Harga: {$product->harga_satuan}
            Deskripsi: {$product->description}

            ";
        }

        // =========================
        // REQUEST KE GROQ
        // =========================

        $response = Http::withHeaders([

            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',

        ])->post('https://api.groq.com/openai/v1/chat/completions', [

            "model" => "llama-3.3-70b-versatile",

            "messages" => [

                [

                    "role" => "system",

                    "content" => "

                    Kamu adalah AI Beauty Consultant untuk website BeautyCare.

                    DAFTAR PRODUK TOKO:

                    $productList

                    =========================

                    ATURAN PENTING:

                    - Kamu hanya boleh merekomendasikan produk dari daftar di atas
                    - Jangan membuat produk sendiri
                    - Jawaban singkat, natural, ramah
                    - Fokus skincare & kosmetik

                    JIKA ADA PRODUK YANG DIREKOMENDASIKAN:

                    WAJIB gunakan format:

                    [PRODUCT_ID:id]

                    contoh:
                    [PRODUCT_ID:1]

                    Bisa lebih dari 1 produk.

                    CONTOH JAWABAN:

                    Untuk kulit kusam kamu bisa coba:

                    [PRODUCT_ID:1]
                    [PRODUCT_ID:3]

                    karena bagus untuk mencerahkan kulit.

                    "

                ],

                [

                    "role" => "user",
                    "content" => $request->message

                ]

            ]

        ]);

        // =========================
        // AMBIL RESPONSE
        // =========================

        $result = $response->json();

        // DEBUG ERROR
        if (!isset($result['choices'])) {

            return response()->json([

                'reply' => 'ERROR GROQ',
                'products' => [],
                'raw' => $result

            ]);
        }

        // =========================
        // AMBIL CHAT AI
        // =========================

        $reply = $result['choices'][0]['message']['content'];

        // =========================
        // AMBIL PRODUCT ID
        // =========================

        preg_match_all('/\[PRODUCT_ID:(\d+)\]/', $reply, $matches);

        $productIds = $matches[1];

        // =========================
        // QUERY PRODUK
        // =========================

        $recommendedProducts = Produk::whereIn(
            'id_produk',
            $productIds
        )->get();

        // =========================
        // HAPUS TAG PRODUCT
        // =========================

        $reply = preg_replace(
            '/\[PRODUCT_ID:\d+\]/',
            '',
            $reply
        );

        // =========================
        // RETURN JSON
        // =========================

        return response()->json([

            'reply' => trim($reply),

            'products' => $recommendedProducts->map(function ($item) {

                return [

                    'id' => $item->id_produk,

                    'name' => $item->nama_produk,

                    'price' => $item->harga_satuan,

                    'image' => str_starts_with($item->image, 'http')
                        ? $item->image
                        : asset('storage/' . $item->image),

                    'description' => $item->description

                ];

            })->values()

        ]);

    } catch (\Exception $e) {

        return response()->json([

            'reply' => 'ERROR: ' . $e->getMessage(),
            'products' => []

        ]);

    }

});