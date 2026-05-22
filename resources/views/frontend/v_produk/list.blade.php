@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{
            font-family:'Inter',sans-serif;
            background:#fff7fa;
            color:#6b4a3a;
        }

        .bg-pink{
            background:#f98fae !important;
        }

        .section-padding{
            padding:120px 0 80px;
        }

        .btn-pink{
            background:#f98fae;
            color:white;
            border:none;
            border-radius:12px;
            transition:.3s;
        }

        .btn-pink:hover{
            background:#f76d95;
            color:white;
            transform:translateY(-2px);
        }

        .product-card{
            border:none;
            border-radius:24px;
            overflow:hidden;
            background:white;
            transition:.3s;
        }

        .product-card:hover{
            transform:translateY(-8px);
            box-shadow:0 15px 30px rgba(249,143,174,.18);
        }

        .product-img{
            height:260px;
            object-fit:cover;
        }

        .product-title{
            color:#6b4a3a;
        }

        .price{
            color:#ff4f81;
            font-weight:700;
            font-size:20px;
        }

        .form-control,
        .form-select{
            border-radius:14px;
            padding:12px;
        }

        .input-group-text{
            border-radius:14px 0 0 14px;
        }

        /* ===== CART MODERN ===== */

        .cart-item{
            display:flex;
            gap:12px;
            background:#fff;
            padding:12px;
            border-radius:18px;
            margin-bottom:12px;
            align-items:center;
            box-shadow:0 5px 15px rgba(0,0,0,0.05);
            transition:.2s;
        }

        .cart-item:hover{
            transform:scale(1.02);
        }

        .cart-img{
            width:65px;
            height:65px;
            border-radius:12px;
            object-fit:cover;
        }

        /* QTY BUTTON */
        .cart-btn{
            width:28px;
            height:28px;
            border-radius:50%;
            border:none;
            background:#ffe4ec;
            color:#ff5f8f;
            font-weight:bold;
        }

        .cart-btn:hover{
            background:#ff5f8f;
            color:white;
        }

        /* REMOVE */
        .cart-remove{
            border:2px solid #ff5f8f;
            background:transparent;
            color:#ff5f8f;
            border-radius:50%;
            width:30px;
            height:30px;
        }

        .cart-remove:hover{
            background:#ff5f8f;
            color:white;
        }

        /* CHECKOUT */
        .btn-checkout{
            background:linear-gradient(135deg,#ff8fb1,#ff5f8f);
            border:none;
            color:white;
            border-radius:50px;
            font-weight:600;
        }

        .btn-checkout:hover{
            transform:scale(1.05);
        }

        /* ADD TO CART BUTTON PRODUK */
        .add-to-cart{
            border-radius:50px !important;
            background:linear-gradient(135deg,#ff8fb1,#ff5f8f) !important;
            border:none !important;
        }

        .add-to-cart:hover{
            transform:scale(1.05);
        }

        .cart-sidebar{
            width:420px !important;
            border-radius:25px 0 0 25px;
            overflow:hidden;
            border:none;
        }

        /* HEADER */
        .offcanvas-header{
            padding:22px 28px;
            background:#fff;
        }

        .offcanvas-header h4{
            font-size:34px;
            font-weight:800;
            color:#ff5f8f;
        }

        .offcanvas-header small{
            color:#999;
            font-size:14px;
        }

        /* BODY */
        .offcanvas-body{
            background:#fafafa;
            padding:24px !important;
        }

        /* CARD ITEM */
        .cart-item{
            display:flex;
            align-items:center;
            gap:16px;
            background:#fff;
            border-radius:24px;
            padding:18px;
            margin-bottom:16px;
            box-shadow:0 5px 20px rgba(0,0,0,.05);
            transition:.2s;
        }

        .cart-item:hover{
            transform:translateY(-2px);
        }

        .cart-img{
            width:78px;
            height:78px;
            border-radius:18px;
            object-fit:cover;
            background:#f8f8f8;
        }

        /* TITLE */
        .cart-item .fw-bold{
            font-size:22px;
            color:#222;
            margin-bottom:8px;
        }

        /* PRICE */
        .cart-price{
            font-size:15px;
            color:#777;
        }

        .cart-subtotal{
            font-size:28px;
            font-weight:800;
            color:#111;
        }

        /* QTY */
        .qty-box{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .cart-btn{
            width:34px;
            height:34px;
            border:none;
            border-radius:50%;
            background:#ffe6ef;
            color:#ff5f8f;
            font-size:18px;
            font-weight:700;
            transition:.2s;
        }

        .cart-btn:hover{
            background:#ff5f8f;
            color:#fff;
        }

        .qty-number{
            font-size:18px;
            font-weight:600;
        }

        /* REMOVE */
        .cart-remove{
            width:42px;
            height:42px;
            border-radius:50%;
            border:2px solid #ff5f8f;
            background:#fff;
            color:#ff5f8f;
            transition:.2s;
        }

        .cart-remove:hover{
            background:#ff5f8f;
            color:white;
        }

        /* SHIPPING CARD */
        .shipping-card{
            background:#fff;
            border-radius:24px;
            padding:24px;
            box-shadow:0 5px 20px rgba(0,0,0,.04);
            border:none;
        }

        .shipping-card h6{
            font-size:26px;
            font-weight:800;
            margin-bottom:20px;
        }

        .form-select,
        .form-control{
            border-radius:14px;
            border:1px solid #eee;
            min-height:46px;
        }

        .form-select:focus,
        .form-control:focus{
            box-shadow:none;
            border-color:#ff8fb1;
        }

        /* BUTTON ONGKIR */
        .btn-ongkir{
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg,#ff5f8f,#ff7ca6);
            color:white;
            font-weight:700;
            height:48px;
        }

        /* TOTAL */
        .cart-total{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-top:25px;
        }

        .cart-total h5{
            font-size:18px;
        }

        .cart-total-price{
            font-size:34px;
            font-weight:800;
            color:#ff3b6d;
        }

        /* CHECKOUT */
        .btn-checkout{
            width:100%;
            height:58px;
            border:none;
            border-radius:50px;
            margin-top:20px;
            background:linear-gradient(135deg,#ff8fb1,#ff5f8f);
            color:white;
            font-weight:700;
            font-size:18px;
            transition:.2s;
        }

        .btn-checkout:hover{
            transform:translateY(-2px);
        }

        /* MOBILE FIX CART */
        @media(max-width:768px){

            .cart-sidebar{
                width:100% !important;
                border-radius:25px 25px 0 0;
            }

            /* HEADER */
            .offcanvas-header{
                padding:16px 18px;
            }

            .cart-title{
                color:#ff5f8f;
                font-size:16px;
                font-weight:800;
            }

            .cart-subtitle{
                font-size:12px;
                color:#999;
            }

            /* BODY */
            .offcanvas-body{
                padding:14px !important;
                background:#fafafa;
            }

            /* ITEM CARD */
            .cart-item{
                display:flex;
                align-items:center;
                gap:12px;
                padding:14px;
                border-radius:18px;
                margin-bottom:12px;
                background:#fff;
                box-shadow:0 4px 15px rgba(0,0,0,.05);
            }

            /* IMAGE */
            .cart-img{
                width:65px;
                height:65px;
                border-radius:14px;
                object-fit:cover;
            }

            /* TITLE */
            .cart-item .fw-bold{
                font-size:16px;
                color:#222;
                margin-bottom:6px;
                line-height:1.4;
            }

            /* PRICE */
            .cart-item small{
                font-size:13px;
            }

            .cart-item strong{
                font-size:16px;
            }

            /* QTY */
            .cart-btn{
                width:30px;
                height:30px;
                font-size:15px;
                border-radius:50%;
            }

            /* DELETE */
            .cart-remove{
                width:36px;
                height:36px;
            }

            /* SHIPPING */
            .shipping-card{
                padding:18px;
                border-radius:18px;
            }

            .shipping-card h6{
                font-size:18px;
            }

            .form-select,
            .form-control{
                min-height:42px;
                font-size:14px;
            }

            /* TOTAL */
            .cart-total h5{
                font-size:15px;
            }

            .cart-total-price{
                font-size:24px;
                font-weight:800;
            }

            /* CHECKOUT */
            .btn-checkout{
                height:50px;
                font-size:15px;
                border-radius:40px;
            }
        }

        .cart-title{
            font-size:14px;
            font-weight:600;
            line-height:1.3;
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
            overflow:hidden;
        }

       
        /* MOBILE */
        @media(max-width:768px){

            .offcanvas{
                width:100% !important;
                border-radius:30px 30px 0 0 !important;
            }

            .offcanvas-header h5{
                font-size:24px;
            }

            .cart-item{
                padding:14px;
                gap:12px;
            }

            .cart-img{
                width:75px;
                height:75px;
            }

            .cart-title{
                font-size:16px;
            }

            .delete-btn{
                width:38px;
                height:38px;
            }
        }


        @media(max-width:768px){

            .section-padding{
                padding:100px 0 50px;
            }

            .product-img{
                height:220px;
            }

        }

            .empty-cart{
            height:100%;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            text-align:center;
            color:#999;
        }

        .empty-cart i{
            font-size:70px;
            color:#ffb3c7;
        }

        .badge-cart{
            background:#fff;
            color:#ff5f8f;
            font-size:11px;
            min-width:20px;
            height:20px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
        } 

    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg bg-pink fixed-top shadow-sm py-3">

    <div class="container">

        <a class="navbar-brand text-white fw-bold fs-3">
            Beautycare
        </a>

        <div class="d-flex align-items-center gap-3">

            {{-- CART --}}
            <a href="#"
                class="position-relative text-white fs-4"
                data-bs-toggle="offcanvas"
                data-bs-target="#cartSidebar">

                <i class="bi bi-cart"></i>

                <span id="cart-count"
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-cart">
                    0
                </span>

            </a>

            <a href="{{ url('/') }}"
                class="btn btn-light fw-semibold rounded-pill px-4">
                Back Home
            </a>

        </div>

    </div>

</nav>

{{-- SECTION --}}
<section class="section-padding">

    <div class="container">

        <div class="text-center mb-5">

            <h1 class="fw-bold display-5">
                Daftar Produk
            </h1>

            <p class="text-muted">
                Temukan produk kecantikan terbaik pilihanmu ✨
            </p>

        </div>

        {{-- SEARCH + FILTER --}}
        <div class="row justify-content-center mb-5">

            <div class="col-md-10">

                <form method="GET">

                    <div class="row g-3">

                        {{-- SEARCH --}}
                        <div class="col-md-6">

                            <div class="input-group shadow-sm rounded-4 overflow-hidden">

                                <span class="input-group-text bg-white border-0">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-0"
                                    placeholder="Cari produk..."
                                    value="{{ request('search') }}"
                                >

                            </div>

                        </div>

                        {{-- FILTER --}}
                        <div class="col-md-4">

                            <select
                                name="kategori"
                                class="form-select border-0 shadow-sm"
                            >

                                <option value="">
                                    Semua Kategori
                                </option>

                                @foreach($kategori as $k)

                                    <option
                                        value="{{ $k->kode }}"
                                        {{ request('kategori') == $k->kode ? 'selected' : '' }}
                                    >
                                        {{ $k->nama_kategori }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- BUTTON --}}
                        <div class="col-md-2">

                            <button class="btn btn-pink w-100 fw-semibold py-3">
                                Filter
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        {{-- PRODUK --}}
        <div class="row">

            @foreach ($produkTerbaru as $item)

                <div class="col-md-3 mb-4">

                    <div class="card product-card h-100 shadow-sm">

                        <a href="{{ route('produk.detail', $item->id_produk) }}"
                            class="text-decoration-none text-dark">

                            <img
                                src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                class="card-img-top product-img"
                                alt="produk"
                            >

                            <div class="card-body">

                                <h5 class="fw-bold product-title">
                                    {{ $item->nama_produk }}
                                </h5>

                                <p class="price mb-2">
                                    Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </p>

                                <p class="text-muted small">
                                    {{ Str::limit($item->description, 90) }}
                                </p>

                            </div>

                        </a>

                        <div class="p-3">

                            <button
                                type="button"
                                class="btn btn-pink w-100 fw-semibold add-to-cart"
                                data-id="{{ $item->id_produk }}"
                                data-name="{{ $item->nama_produk }}"
                                data-price="{{ $item->harga_satuan }}"
                                data-image="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                            >
                                <i class="bi bi-cart-plus-fill"></i>
                            Tambah ke Keranjang
                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

<!-- MODERN CART SIDEBAR -->
<div class="offcanvas offcanvas-end cart-sidebar" tabindex="-1" id="cartSidebar">

    <div class="offcanvas-header border-bottom px-4 py-3">

        <div>
            <h4 class="cart-title mb-0">
                <i class="bi bi-cart me-1"></i>
                Keranjang
            </h4>

            <small class="cart-subtitle">
                Produk pilihan kamu
            </small>
        </div>

        <button class="btn-close shadow-none" data-bs-dismiss="offcanvas"></button>

    </div>

    <div class="offcanvas-body p-3" id="cartContent">

        <div class="empty-cart">

            <div class="empty-icon">
                <i class="bi bi-cart-x"></i>
            </div>

            <h5 class="fw-bold mt-4">
                Cart masih kosong
            </h5>

            <p class="text-muted small">
                Yuk tambahin skincare favorit kamu 💖
            </p>

        </div>

    </div>

</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- ADD TO CART --}}
<script>

document.querySelectorAll('.add-to-cart').forEach(btn => {

    btn.addEventListener('click', function(){

        fetch('/cart/add', {

            method:'POST',

            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },

            body:JSON.stringify({

                id:this.dataset.id,
                name:this.dataset.name,
                price:this.dataset.price,
                image:this.dataset.image

            })

        })

        .then(res => res.json())

        .then(() => {

            loadCart();

            let sidebar =
                new bootstrap.Offcanvas(
                    document.getElementById('cartSidebar')
                );

            sidebar.show();

        });

    });

});

function loadCart(){

    fetch('/cart/data')

    .then(res => res.json())

    .then(data => {

        let html = '';
        let totalQty = 0;

        if(Object.keys(data).length === 0){

            html = `
                <div class="empty-cart">

                    <i class="bi bi-cart-x"></i>

                    <p class="mt-3">
                        Belum ada barang
                    </p>

                </div>
            `;

        }else{

            for(let id in data){

                let item = data[id];

                totalQty += item.qty;

                html += `
                    <div class="cart-item">

                        <img 
                            src="${item.image}"
                            class="cart-img"
                        >

                        <div class="flex-grow-1">

                            <div class="cart-title mb-1">
                                ${item.name}
                            </div>

                            <div class="price mb-3">
                                Rp ${parseInt(item.price).toLocaleString('id-ID')}
                            </div>

                            <div class="d-flex align-items-center justify-content-between">

                                <div class="qty-box">

                                    <button
                                        class="cart-btn"
                                        onclick="updateQty(${id}, 'minus')">
                                        -
                                    </button>

                                    <span class="qty-number">
                                        ${item.qty}
                                    </span>

                                    <button
                                        class="cart-btn"
                                        onclick="updateQty(${id}, 'plus')">
                                        +
                                    </button>

                                </div>

                                <button
                                    class="cart-remove"
                                    onclick="removeItem(${id})">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </div>

                    </div>
                `;
            }

        }

        document.getElementById('cartContent').innerHTML = html;

        document.getElementById('cart-count').innerText =
            totalQty;

    });

}

function removeItem(id){

    fetch('/cart/remove', {

        method:'POST',

        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },

        body:JSON.stringify({
            id:id
        })

    })

    .then(() => loadCart());

}

function updateQty(id, action){

    fetch('/cart/update', {

        method:'POST',

        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },

        body:JSON.stringify({

            id:id,
            action:action

        })

    })

    .then(() => loadCart());

}

loadCart();

</script>

@include('frontend.components.ai-chat')

</body>
</html>