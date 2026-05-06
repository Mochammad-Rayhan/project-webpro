<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-accent: #f98fae; 
            --brand-accent-soft: #fff0f4; 
            --surface: #ffffff;
            --surface-2: #f8f9fc;
            --border: #e8eaed;
            --text-main: #111827;
            --text-muted: #6b7280;
            --radius-sm: 8px;
            --radius-lg: 16px;
            --shadow-card: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
        }

        body {
            background: var(--surface-2);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .page-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            padding: 48px 24px 80px;
        }

        .btn-back {
            display: inline-flex;
            padding: 7px 16px;
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            background: var(--surface);
            border: 1px solid var(--border);
            text-decoration: none;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background: var(--brand-accent-soft);
            color: var(--brand-accent);
        }

        .orders-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            background: #fafafa;
            border-bottom: 2px solid var(--border);
            padding: 14px 20px;
        }

        .orders-table td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
        }

        .order-id {
            color: var(--brand-accent);
            font-weight: 600;
        }

        /* 🔥 Pagination Styling */
        .pagination-wrapper {
            margin-top: 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .pagination-info { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; }

        .pagination-wrapper nav > div:first-child,
        .pagination-wrapper nav > div:last-child > div:first-child {
            display: none !important;
        }

        .pagination-info {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

    </style>
</head>
<body>

<div class="page-wrapper">

    <a href="{{ url('/') }}" class="btn-back">← Kembali</a>

    <h4>Riwayat Pesanan</h4>

    @if(isset($orders) && $orders->count() > 0)

        <div class="orders-card">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Lokasi</th>
                        <th>Kurir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $i => $order)
                    <tr>
                        <td>{{ $orders->firstItem() + $i }}</td>
                        <td class="order-id">#{{ $order->order_id }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                        <td>{{ $order->city }}, {{ $order->province }}</td>
                        <td>{{ $order->courier }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 🔥 FIXED PAGINATION -->
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Showing 
                <b>{{ $orders->firstItem() }}</b> 
                to 
                <b>{{ $orders->lastItem() }}</b> 
                of 
                <b>{{ $orders->total() }}</b> 
                results
            </div>

            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    @else
        <div class="orders-card p-5 text-center">
            <h6>Belum ada pesanan</h6>
        </div>
    @endif

</div>

</body>
</html>