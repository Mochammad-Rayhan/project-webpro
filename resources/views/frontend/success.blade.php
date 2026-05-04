<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand: #f98fae;
            --brand-light: #fff4f7;
            --brand-dark: #e0668d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .font-title {
            font-family: 'Sora', sans-serif;
        }

        .badge-brand {
            background: var(--brand-light);
            color: var(--brand-dark);
        }

        .total-box {
            background: var(--brand-light);
        }

        .btn-brand {
            background: var(--brand);
            color: #fff;
            border: none;
        }

        .btn-brand:hover {
            background: var(--brand-dark);
        }

        tbody tr:hover {
            background: #fafafa;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="mx-auto" style="max-width: 640px;">

        <!-- STATUS -->
        <span class="badge badge-brand rounded-pill px-3 py-2 mb-3">
            ● Pembayaran dikonfirmasi
        </span>

        <!-- TITLE -->
        <h1 class="font-title fs-4 fw-bold mb-1">Pesanan berhasil</h1>
        <p class="text-muted mb-4">Terima kasih, transaksi Anda telah kami terima.</p>

        <!-- META -->
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-body py-3">

                <div class="d-flex justify-content-between border-bottom py-2">
                    <span class="text-muted small">Order ID</span>
                    <span class="small text-muted font-monospace">#{{ $transaction->order_id }}</span>
                </div>

                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted small">Nama pembeli</span>
                    <span class="small fw-medium">{{ auth()->user()->nama }}</span>
                </div>

            </div>
        </div>

        <!-- SECTION -->
        <p class="text-uppercase small text-muted mb-2" style="letter-spacing: .08em;">
            Rincian pesanan
        </p>

        <!-- TABLE -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">

                <table class="table align-middle mb-0 table-borderless">
                    <thead class="text-muted small" style="background:#fafafa;">
                        <tr>
                            <th class="px-4 py-3">Produk</th>
                            <th class="text-end px-4 py-3">Qty</th>
                            <th class="text-end px-4 py-3">Harga</th>
                            <th class="text-end px-4 py-3">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($transaction->details as $item)
                        <tr style="border-top: 1px solid #f1f1f1;">
                            <td class="px-4 py-3 fw-medium">
                                {{ $item->product_name }}
                            </td>

                            <td class="text-end px-4 py-3">
                                <span class="badge rounded-2 px-2 py-1"
                                      style="background:#fff4f7; color:#e0668d;">
                                    {{ $item->qty }}
                                </span>
                            </td>

                            <td class="text-end px-4 py-3">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>

                            <td class="text-end px-4 py-3 fw-semibold">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

        <!-- TOTAL -->
        <div class="d-flex justify-content-between align-items-center rounded-4 px-4 py-3 mt-3 total-box">
            <span class="small text-muted">Total pembayaran</span>
            <span class="fw-bold fs-5 font-title">
                Rp {{ number_format($transaction->total, 0, ',', '.') }}
            </span>
        </div>

        <!-- BUTTON -->
        <a href="/" class="btn btn-brand w-100 mt-4 py-2 rounded-3">
            ← Kembali ke beranda
        </a>

    </div>
</div>

</body>
</html>