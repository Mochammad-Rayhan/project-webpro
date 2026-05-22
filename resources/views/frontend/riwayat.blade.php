@extends('frontend.v_layouts.app')

@section('content')

<style>
    body{
        background:#f5f6fa;
        font-family:'Inter',sans-serif;
    }

    .profile-wrapper{
        padding-top:120px;
        padding-bottom:60px;
        min-height:100vh;
    }

    .profile-card{
        background:white;
        border-radius:30px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
    }

    .sidebar-profile{
        background:#fff0f5;
        min-height:100%;
        padding:40px 25px;
        border-right:1px solid #eee;
    }

    .profile-avatar{
        width:100px;
        height:100px;
        object-fit:cover;
        border-radius:50%;
        border:5px solid #ff8fb1;
    }

    .menu-profile a{
        display:block;
        padding:12px 16px;
        border-radius:14px;
        text-decoration:none;
        color:#555;
        margin-bottom:10px;
        transition:.2s;
        font-weight:500;
    }

    .menu-profile a:hover,
    .menu-profile a.active{
        background:#ff8fb1;
        color:white;
    }

    .logout-btn{
        width:100%;
        text-align:left;
        padding:12px 16px;
        border-radius:14px;
        border:none;
        background:transparent;
        color:#555;
        margin-bottom:10px;
        transition:.2s;
        font-weight:500;
    }

    .logout-btn:hover{
        background:#ff8fb1;
        color:white;
    }

    .content-area{
        padding:50px;
    }

    .page-title{
        font-weight:800;
        color:#444;
        margin-bottom:30px;
    }

    .orders-card{
        border:1px solid #eee;
        border-radius:20px;
        overflow:hidden;
    }

    .orders-table{
        width:100%;
        border-collapse:collapse;
    }

    .orders-table th{
        background:#fafafa;
        padding:16px;
        font-weight:700;
        border-bottom:1px solid #eee;
    }

    .orders-table td{
        padding:16px;
        border-bottom:1px solid #f1f1f1;
    }

    .order-id{
        color:#ff5f8f;
        font-weight:700;
    }

    .pagination-wrapper{
        margin-top:25px;
    }

    @media(max-width:768px){

        .content-area{
            padding:25px;
        }

        .sidebar-profile{
            border-right:none;
            border-bottom:1px solid #eee;
        }

        .orders-table{
            font-size:13px;
        }
    }

    .btn-back-home{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:14px;
        background:#fff0f5;
        color:#ff5f8f;
        text-decoration:none;
        font-weight:600;
        transition:.2s;
        }

    .btn-back-home:hover{
        background:#ff8fb1;
        color:white;
        }

    .top-action{
        display:flex;
        align-items:center;
    }

    .btn-back-home{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:14px;
        background:#fff;
        color:#ff5f8f;
        text-decoration:none;
        font-weight:600;
        border:1px solid #f3d4df;
        box-shadow:0 4px 12px rgba(0,0,0,0.04);
        transition:.2s;
    }

    .btn-back-home:hover{
        background:#ff8fb1;
        color:white;
    }
</style>

<div class="container profile-wrapper">

    <div class="top-action mb-3">
        <a href="{{ url('/') }}" class="btn-back-home">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Home
        </a>
    </div>

    <div class="profile-card">

        <div class="row g-0">

            <!-- SIDEBAR -->
            <div class="col-lg-3">

                <div class="sidebar-profile text-center">

                    <img 
                        src="{{ asset('storage/img-user/' . Auth::user()->foto) }}"
                        class="profile-avatar mb-3"
                    >

                    <h5 class="fw-bold">
                        {{ Auth::user()->nama }}
                    </h5>

                    <small class="text-muted">
                        {{ Auth::user()->email }}
                    </small>

                    <div class="menu-profile mt-5 text-start">

                        <a href="{{ route('profile') }}">
                            <i class="bi bi-person"></i>
                            Profile
                        </a>

                        <a href="{{ route('orders.riwayat') }}"
                        class="active">
                            <i class="bi bi-bag"></i>
                            Pesanan
                        </a>

                        {{-- <a href="{{ route('password.form') }}"
                        class="{{ request()->routeIs('password.form') ? 'active' : '' }}">
                            <i class="bi bi-shield-lock"></i>
                            Password
                        </a> --}}

                        <form action="{{ route('backend.logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="logout-btn">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="col-lg-9">

                <div class="content-area">

                    <h2 class="page-title">
                        Riwayat Pesanan
                    </h2>

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

                                        <td>
                                            {{ $orders->firstItem() + $i }}
                                        </td>

                                        <td class="order-id">
                                            #{{ $order->order_id }}
                                        </td>

                                        <td>
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>

                                        <td>
                                            Rp {{ number_format($order->total,0,',','.') }}
                                        </td>

                                        <td>
                                            {{ $order->city }},
                                            {{ $order->province }}
                                        </td>

                                        <td>
                                            {{ $order->courier }}
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="pagination-wrapper">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>

                    @else

                        <div class="orders-card p-5 text-center">
                            <h6 class="mb-0">
                                Belum ada pesanan
                            </h6>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection