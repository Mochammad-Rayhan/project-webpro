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
            font-family: 'Inter', sans-serif;
            background: #fff7fa;
        }

        .bg-pink{
            background-color: #f98fae !important;
        }

        .section-padding{
            padding: 120px 0 80px;
        }

        .product-card{
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: .3s;
            background: white;
        }

        .product-card:hover{
            transform: translateY(-8px);
        }

        .product-img{
            height: 260px;
            object-fit: cover;
        }

        .product-title{
            color: #6b4a3a;
        }

        .price{
            color: #ff4f81;
            font-weight: 700;
        }

        .btn-pink{
            background: #f98fae;
            color: white;
            border: none;
        }

        .btn-pink:hover{
            background: #f76d95;
            color: white;
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg bg-pink fixed-top shadow-sm py-3">
    <div class="container">

        <a class="navbar-brand text-white fw-bold fs-3" href="#">
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
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
            </a>

            <a href="{{ url('/') }}"
                class="btn btn-light fw-semibold">
                Back Home
            </a>

        </div>

    </div>
</nav>

{{-- SECTION --}}
<section class="section-padding">

    <div class="container">

        <div class="text-center mb-5">
            <h1 class="fw-bold display-5" style="color:#6b4a3a;">
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

                            <div class="input-group">

                                <span class="input-group-text bg-white border-0 shadow-sm">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-0 shadow-sm"
                                    placeholder="Cari produk..."
                                    value="{{ request('search') }}"
                                >

                            </div>

                        </div>

                        {{-- FILTER KATEGORI --}}
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

                            <button
                                class="btn btn-pink w-100 fw-semibold"
                            >
                                Filter
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="row">

            @foreach ($produkTerbaru as $item)

                <div class="col-md-3 mb-4">

                    <div class="card shadow-sm product-card h-100">

                        <a href="{{ route('produk.detail', $item->id_produk) }}"
                            class="text-decoration-none text-dark">

                            <img
                                src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                class="card-img-top product-img"
                                alt="produk">

                            <div class="card-body">

                                <h5 class="fw-bold product-title">
                                    {{ $item->nama_produk }}
                                </h5>

                                <p class="price">
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
                                + Add To Cart
                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>
        </div>

    </div>

</section>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="productModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-body p-4">

                <div class="row align-items-center">

                    <div class="col-md-5">
                        <img id="modalImage"
                            src=""
                            class="img-fluid rounded-4 shadow-sm">
                    </div>

                    <div class="col-md-7">

                        <h2 id="modalTitle"
                            class="fw-bold mb-3">
                        </h2>

                        <h4 id="modalPrice"
                            class="fw-bold text-danger mb-3">
                        </h4>

                        <p id="modalDescription"
                            class="text-muted mb-4">
                        </p>

                        <button
                            id="modalAddToCart"
                            class="btn btn-pink w-100 py-2 fw-semibold">
                            + Tambahkan Ke Keranjang
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- CART SIDEBAR --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar">

    <div class="offcanvas-header">
        <h5>Keranjang</h5>

        <button class="btn-close"
            data-bs-dismiss="offcanvas">
        </button>
    </div>

    <div class="offcanvas-body" id="cartContent">
        <p>Belum ada barang</p>
    </div>

</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- MODAL DETAIL --}}
<script>
document.querySelectorAll('.btn-detail').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('modalTitle').innerText =
            this.dataset.title;

        document.getElementById('modalPrice').innerText =
            this.dataset.price;

        document.getElementById('modalDescription').innerText =
            this.dataset.description;

        document.getElementById('modalImage').src =
            this.dataset.image;

        let modalBtn =
            document.getElementById('modalAddToCart');

        modalBtn.setAttribute('data-id', this.dataset.id);

        modalBtn.setAttribute('data-name', this.dataset.title);

        modalBtn.setAttribute(
            'data-price',
            this.dataset.price
                .replace('Rp ','')
                .replace(/\./g,'')
        );

        modalBtn.setAttribute(
            'data-image',
            this.dataset.image
        );

    });

});
</script>

{{-- ADD TO CART --}}
<script>

document.querySelectorAll('.add-to-cart').forEach(btn => {

    btn.addEventListener('click', function() {

        fetch('/cart/add', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            body: JSON.stringify({
                id: this.dataset.id,
                name: this.dataset.name,
                price: this.dataset.price,
                image: this.dataset.image
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

</script>

{{-- ADD TO CART DARI MODAL --}}
<script>

document.addEventListener('click', function(e){

    if(e.target.id === 'modalAddToCart'){

        fetch('/cart/add', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            body: JSON.stringify({

                id: e.target.dataset.id,
                name: e.target.dataset.name,
                price: e.target.dataset.price,
                image: e.target.dataset.image

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

    }

});

</script>

{{-- LOAD CART --}}
<script>

function loadCart(){

    fetch('/cart/data')

    .then(res => res.json())

    .then(data => {

        let html = '';
        let totalQty = 0;

        if(Object.keys(data).length === 0){

            html = '<p>Belum ada barang</p>';

        }else{

            for(let id in data){

                let item = data[id];

                totalQty += item.qty;

                html += `
                    <div class="d-flex mb-3">

                        <img src="${item.image}"
                            width="60"
                            height="60"
                            class="rounded me-2"
                            style="object-fit:cover;">

                        <div class="w-100">

                            <h6 class="mb-1">${item.name}</h6>

                            <small>
                                Rp ${item.price}
                            </small>

                            <div class="d-flex align-items-center gap-2 mt-2">

                                <button
                                    class="btn btn-sm btn-outline-secondary"
                                    onclick="updateQty(${id}, 'minus')">
                                    -
                                </button>

                                <span>${item.qty}</span>

                                <button
                                    class="btn btn-sm btn-outline-secondary"
                                    onclick="updateQty(${id}, 'plus')">
                                    +
                                </button>

                                <button
                                    class="btn btn-sm btn-danger ms-auto"
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

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },

        body: JSON.stringify({ id:id })

    })

    .then(() => loadCart());

}

function updateQty(id, action){

    fetch('/cart/update', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },

        body: JSON.stringify({
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