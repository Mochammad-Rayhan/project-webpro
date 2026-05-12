@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{
            background:#fff7fa;
            font-family:'Inter', sans-serif;
        }

        .bg-pink{
            background:#f98fae !important;
        }

        .btn-pink{
            background:#f98fae;
            color:white;
            border:none;
        }

        .btn-pink:hover{
            background:#f76d95;
            color:white;
        }

        .product-img{
            border-radius:25px;
            width:100%;
            height:500px;
            object-fit:cover;
        }

        .price{
            color:#ff4f81;
            font-weight:800;
            font-size:32px;
        }

        .benefit-box{
            background:white;
            border-radius:20px;
            padding:20px;
            box-shadow:0 5px 15px rgba(0,0,0,.05);
        }

        .similar-card{
            border:none;
            border-radius:20px;
            overflow:hidden;
            transition:.3s;
        }

        .similar-card:hover{
            transform:translateY(-5px);
        }

        .similar-img{
            height:220px;
            object-fit:cover;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-pink py-3 shadow-sm">

    <div class="container">

        <a class="navbar-brand text-white fw-bold fs-3">
            Beautycare
        </a>

        <a href="{{ route('produk.list') }}"
            class="btn btn-light fw-semibold">
            ← Kembali
        </a>

    </div>

</nav>

<section class="py-5">

    <div class="container">

        <div class="row align-items-center g-5">

            {{-- IMAGE --}}
            <div class="col-md-5">

                <img
                    src="{{ Str::startsWith($produk->image, 'http') ? $produk->image : asset('storage/' . $produk->image) }}"
                    class="product-img shadow"
                >

            </div>

            {{-- DETAIL --}}
            <div class="col-md-7">

                <span class="badge bg-pink mb-3 px-3 py-2">
                    {{ $produk->kode }}
                </span>

                <h1 class="fw-bold mb-3">
                    {{ $produk->nama_produk }}
                </h1>

                <div class="price mb-3">
                    Rp {{ number_format($produk->harga_satuan,0,',','.') }}
                </div>

                <p class="text-muted mb-4">
                    {{ $produk->description }}
                </p>

                <div class="d-flex gap-3 mb-4">

                    <button
                        class="btn btn-pink px-5 py-3 fw-semibold add-to-cart"
                        data-id="{{ $produk->id_produk }}"
                        data-name="{{ $produk->nama_produk }}"
                        data-price="{{ $produk->harga_satuan }}"
                        data-image="{{ Str::startsWith($produk->image, 'http') ? $produk->image : asset('storage/' . $produk->image) }}"
                    >
                        <i class="bi bi-cart-plus"></i>
                        Tambahkan Keranjang
                    </button>

                </div>

                {{-- MANFAAT --}}
                <div class="benefit-box">

                    <h4 class="fw-bold mb-3">
                        Manfaat Produk ✨
                    </h4>

                    <ul class="mb-0">

                        <li>Membantu merawat kulit lebih sehat</li>
                        <li>Membuat kulit terasa lebih segar</li>
                        <li>Memberikan nutrisi pada kulit</li>
                        <li>Cocok digunakan sehari-hari</li>

                    </ul>

                </div>

            </div>

        </div>

        {{-- REKOMENDASI --}}
        <div class="mt-5">

            <h2 class="fw-bold mb-4">
                Produk Serupa
            </h2>

            <div class="row">

                @forelse($rekomendasi as $item)

                    <div class="col-md-3 mb-4">

                        <a
                            href="{{ route('produk.detail', $item->id_produk) }}"
                            class="text-decoration-none text-dark"
                        >

                            <div class="card similar-card shadow-sm h-100">

                                <img
                                    src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                    class="card-img-top similar-img"
                                >

                                <div class="card-body">

                                    <h6 class="fw-bold">
                                        {{ $item->nama_produk }}
                                    </h6>

                                    <p class="text-danger fw-semibold mb-0">
                                        Rp {{ number_format($item->harga_satuan,0,',','.') }}
                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <p class="text-muted">
                        Belum ada produk serupa
                    </p>

                @endforelse

            </div>

        </div>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.querySelector('.add-to-cart').addEventListener('click', function(){

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

        alert('Produk berhasil ditambahkan ke keranjang');

    });

});

</script>

</body>
</html>