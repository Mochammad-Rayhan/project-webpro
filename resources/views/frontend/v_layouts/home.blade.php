@php
use Illuminate\Support\Str;
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>

        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-pink {
            background-color: #f98fae !important; /* pink pastel */
        }
        .testimonial-card {
            background-color: #ffffff;
            border-radius: 1.25rem;
            min-height: 100%;
            overflow: hidden;
        }
        .testimonial-card .card-body {
            min-height: 350px;
            padding-top: 3rem !important;
        }
        .testimonial-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #f98fae;
            margin-top: -45px;
            background-color: #ffffff;
        }
        .testimonial-quote {
            color: #5c4a42;
            line-height: 1.7;
        }
        .testimonial-name {
            color: #6b4a3a;
        }
    </style>
</head>
<body>
    <nav class="navbar fixed-top shadow-lg navbar-expand-lg py-2 bg-pink">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- KIRI (Logo) -->
            <a class="navbar-brand text-white fs-3 fw-bold" href="#">Beautycare</a>

            <!-- BUTTON TOGGLER (mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- TENGAH + KANAN -->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                <!-- TENGAH (Menu) -->
                <div class="navbar-nav mx-auto">
                    <a class="nav-link text-white fs-5 active" href="#">Home</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#about">About Us</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#produk">Produk</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#testimoni">Testimoni</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#contact">Contact</a>
                </div>

                <!-- KANAN (Button Login) -->
                <div class="d-flex align-items-center gap-4">
                    @if(Auth::check())
                        {{-- ICON CART --}}
                        <a href="#" class="position-relative text-white fs-4" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                            <i class="bi bi-cart"></i>
                            <span id="cart-count" style="font-size: 13px;" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        </a>
                        {{-- USER DROPDOWN --}}
                        <div class="dropdown">
                            <button class="btn btn-light d-flex align-items-center gap-2 dropdown-toggle" data-bs-toggle="dropdown">
                                {{-- FOTO PROFIL --}}
                                <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" 
                                    alt="user" 
                                    width="25" 
                                    height="25" 
                                    class="rounded-circle">
                                {{-- NAMA USER --}}
                                <span style="font-size: 13px;">{{ Auth::user()->nama }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('orders.riwayat') }}">Pesanan Saya</a></li>
                                <li>
                                    <form action="{{ route('backend.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('backend.login') }}" class="btn btn-light fw-semibold">Login</a>    
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-white">
                    <h1 class="fw-bold display-4">
                        Welcome To <br> Our BeautyCare Shop
                    </h1>
                    <p class="mt-3">
                        Kami menyediakan berbagai produk kosmetik berkualitas tinggi
                        untuk menunjang kecantikan dan kepercayaan diri Anda setiap hari.
                    </p>
                    <a href="#" class="btn btn-outline-light mt-3 px-4 py-2">
                        View Product
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- BEST SELLER SECTION -->
    <section class="section-padding bg-light">
        <div class="container text-center">
            <!-- Judul -->
            <h2 class="fw-bold display-5" style="color: #6b4a3a;">
                Produk paling laris
            </h2>
            <!-- Deskripsi -->
            <p class="mt-3 text-muted">
                Produk pilihan terbaik dengan kualitas premium yang paling diminati pelanggan kami.
            </p>
            <!-- Produk -->
            <div class="row mt-5">
                <!-- Produk 1 -->
                 @foreach ($products as $item)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="produk">
                            <div class="card-body text-start">
                                <h5 class="fw-bold fs-4">{{ $item->nama_produk }}</h5>
                                <p class="text-muted small">{{ Str::limit($item->description, 130) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-semibold">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    <p class="text-black py-1 px-4 text-white rounded-pill bg-pink fw-semibold">{{ $item->kategori->nama_kategori }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="section-padding" id="about" style="background-color: #fddae4;">
        <!-- <h1 class="text-center text-black fw-bold">About Us</h1> -->
        <div class="container">
        <!-- Judul -->
            <h1 class="text-center display-5 fw-bold mb-5" style="color: #6b4a3a;">
                Tentang kami
            </h1>
            <div class="row align-items-center">
                <!-- Gambar -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1601070846144-6be3aad73f7b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                            class="img-fluid rounded-4 shadow-sm about-img" 
                            alt="About Beautycare">
                        <!-- shadow layer belakang -->
                        <div class="about-shadow"></div>
                    </div>
                </div>
                <!-- Teks -->
                <div class="col-md-6">
                    <h6 class="fw-semibold text-uppercase" style="color: #6b4a3a;">
                        Kenapa Harus Beautycare?
                    </h6>
                    <h2 class="fw-bold mb-3" style="color: #6b4a3a;">
                        Solusi Kebutuhan Kecantikan Anda
                    </h2>
                    <p class="text-muted text-justify">
                        Beautycare hadir sebagai penyedia produk kosmetik dan perawatan diri yang terpercaya, menghadirkan berbagai pilihan produk berkualitas dari brand ternama maupun produk pilihan terbaik.
                    </p>
                    <p class="text-muted text-justify">
                        Kami berkomitmen untuk memenuhi kebutuhan kecantikan dan perawatan kulit Anda dengan produk yang aman, original, dan telah teruji kualitasnya. Dengan koleksi yang lengkap, mulai dari skincare, makeup, hingga body care, Beautycare menjadi solusi praktis untuk menunjang penampilan dan kepercayaan diri Anda.
                    </p>
                    <p class="text-muted text-justify">
                        Kenyamanan berbelanja juga menjadi prioritas kami. Melalui layanan yang mudah, cepat, dan terpercaya, kami ingin memberikan pengalaman terbaik bagi setiap pelanggan dalam menemukan produk kecantikan yang sesuai dengan kebutuhan mereka.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk -->
    <section class="section-padding" id="produk">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="fw-bold">Daftar Produk</h3>
            <a href="#" class="btn bg-pink text-white btn-sm">See All Products</a>
        </div>
        <div class="row">
            @foreach ($produkTerbaru as $item)
                <div class="col-md-3 mb-5">
                    <div class="card border-0 shadow-sm h-200">
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="produk">
                            <div class="card-body text-start">
                                <h5 class="fw-bold fs-5 mb-2">{{ $item->nama_produk }}</h5>
                                <p class="fw-semibold">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                <p class="text-muted small mb-0">{{ Str::limit($item->description, 100) }}</p>
                                <!-- <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-black py-0.8 px-3 mb-4 text-white rounded-pill d-inline-block bg-pink">{{ $item->kategori->nama_kategori }}</p>
                                </div> -->
                            </div>
                            <div class="d-flex gap-2 p-3">
                                <!-- Detail kecil -->
                                <button 
                                    class="btn btn-outline-secondary btn-detail"
                                    data-bs-toggle="modal"
                                    data-bs-target="#productModal"
                                    data-title="{{ $item->nama_produk }}"
                                    data-price="Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}"
                                    data-description="{{ $item->description }}"
                                    data-image="{{ asset('storage/' . $item->image) }}"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                                <!-- Cart besar -->
                                <button type="button" class="btn bg-pink text-white w-100 fw-semibold add-to-cart" data-id="{{ $item->id_produk }}" data-name="{{ $item->nama_produk }}" data-price="{{ $item->harga_satuan }}" data-image="{{ asset('storage/' . $item->image) }}"> + Add to Cart</button>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Testimoni Start -->
    <section class="section-padding py-5" id="testimoni" style="background-color: #fddae4;">
        <div class="container position-relative">
            <!-- Heading -->
            <div class="text-center mb-4">
                <h1 class="fw-bold display-5 mb-3" style="color: #6b4a3a;">
                    Testimoni Pengguna
                </h1>
                <p class="text-muted fs-6 mx-auto mb-0" style="max-width: 650px;">
                    Pendapat pelanggan yang telah menggunakan produk dan layanan dari Beautycare.
                </p>
            </div>
            <!-- Carousel -->
            <div id="testimonialCarousel"
                class="carousel slide"
                data-bs-ride="carousel"
                data-bs-interval="4000">
                <!-- Indicators -->
                <div class="carousel-indicators position-relative mb-4 mt-3">
                    <button type="button"
                        data-bs-target="#testimonialCarousel"
                        data-bs-slide-to="0"
                        class="active bg-dark"
                        style="width:10px;height:10px;border-radius:50%;">
                    </button>
                    <button type="button"
                        data-bs-target="#testimonialCarousel"
                        data-bs-slide-to="1"
                        class="bg-dark"
                        style="width:10px;height:10px;border-radius:50%;">
                    </button>
                </div>
                <!-- Carousel Inner -->
                <div class="carousel-inner">
                    <!-- ================= SLIDE 1 ================= -->
                    <div class="carousel-item active">
                        <div class="row g-4">
                            <!-- CARD 1 -->
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100 bg-white p-4"
                                    style="border-radius: 16px;">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                            alt="user"
                                            class="rounded-circle me-3"
                                            width="65"
                                            height="65"
                                            style="object-fit: cover;">
                                        <div>
                                            <h5 class="fw-semibold mb-1">
                                                Aulia Rahma
                                            </h5>
                                            <div class="text-warning small mb-1">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <small class="text-muted">
                                                Pelanggan Beautycare
                                            </small>
                                        </div>
                                    </div>
                                    <!-- Isi -->
                                    <p class="text-muted mb-0 lh-lg">
                                        Produknya original dan kualitasnya bagus banget.
                                        Pengiriman cepat dan packaging aman.
                                    </p>
                                </div>
                            </div>
                            <!-- CARD 2 -->
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100 bg-white p-4"
                                    style="border-radius: 16px;">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg"
                                            alt="user"
                                            class="rounded-circle me-3"
                                            width="65"
                                            height="65"
                                            style="object-fit: cover;">
                                        <div>
                                            <h5 class="fw-semibold mb-1">
                                                Nabila Putri
                                            </h5>
                                            <div class="text-warning small mb-1">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                            <small class="text-muted">
                                                Verified Buyer
                                            </small>
                                        </div>
                                    </div>
                                    <!-- Isi -->
                                    <p class="text-muted mb-0 lh-lg">
                                        Skincare di Beautycare cocok untuk kulit sensitif saya.
                                        Websitenya clean dan nyaman digunakan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ================= SLIDE 2 ================= -->
                    <div class="carousel-item">
                        <div class="row g-4">
                            <!-- CARD 3 -->
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100 bg-white p-4"
                                    style="border-radius: 16px;">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                            alt="user"
                                            class="rounded-circle me-3"
                                            width="65"
                                            height="65"
                                            style="object-fit: cover;">
                                        <div>
                                            <h5 class="fw-semibold mb-1">
                                                Fajar Nugraha
                                            </h5>
                                            <div class="text-warning small mb-1">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <small class="text-muted">
                                                Top Customer
                                            </small>
                                        </div>
                                    </div>
                                    <!-- Isi -->
                                    <p class="text-muted mb-0 lh-lg">
                                        Produknya lengkap dan harga masih terjangkau.
                                        Customer service juga cepat dan ramah.
                                    </p>
                                </div>
                            </div>
                            <!-- CARD 4 -->
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm h-100 bg-white p-4"
                                    style="border-radius: 16px;">

                                    <!-- Header -->
                                    <div class="d-flex align-items-center mb-3">

                                        <img src="https://randomuser.me/api/portraits/women/33.jpg"
                                            alt="user"
                                            class="rounded-circle me-3"
                                            width="65"
                                            height="65"
                                            style="object-fit: cover;">

                                        <div>
                                            <h5 class="fw-semibold mb-1">
                                                Salsa Anindya
                                            </h5>

                                            <div class="text-warning small mb-1">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star"></i>
                                            </div>

                                            <small class="text-muted">
                                                Happy Customer
                                            </small>
                                        </div>

                                    </div>

                                    <!-- Isi -->
                                    <p class="text-muted mb-0 lh-lg">
                                        Beautycare jadi tempat favorit saya beli skincare.
                                        Checkout mudah dan tampilannya modern.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- BUTTON PREV -->
                <button class="carousel-control-prev"
                    type="button"
                    data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev"
                    style="width: auto; left: -65px;">

                    <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width:48px; height:48px;">

                        <i class="bi bi-chevron-left text-dark fs-5"></i>

                    </div>
                </button>

                <!-- BUTTON NEXT -->
                <button class="carousel-control-next"
                    type="button"
                    data-bs-target="#testimonialCarousel"
                    data-bs-slide="next"
                    style="width: auto; right: -65px;">

                    <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width:48px; height:48px;">

                        <i class="bi bi-chevron-right text-dark fs-5"></i>

                    </div>
                </button>

            </div>

        </div>

    </section>
     <!-- Testimoni End -->


    <!-- Modalbox -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-5">
                        <img id="modalImage" src="" class="img-fluid rounded">
                    </div>
                    <div class="col-md-7">
                        <h4 id="modalTitle"></h4>
                        <p id="modalPrice" class="fw-semibold"></p>
                        <p id="modalDescription"></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sidebar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar">
        <div class="offcanvas-header">
            <h5>Cart</h5>
            <button class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body" id="cartContent">
            <p>Belum ada barang</p>
        </div>
    </div>

<!-- Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
</script>

<!-- Modalbox js -->
<script>
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('modalTitle').innerText = this.dataset.title;
            document.getElementById('modalPrice').innerText = this.dataset.price;
            document.getElementById('modalDescription').innerText = this.dataset.description;
            document.getElementById('modalImage').src = this.dataset.image;
    });

});
</script>

<script>
    let selectedOngkir = 0; // variabel global untuk menyimpan ongkir yang dipilih
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!isLoggedIn) {
                    window.location.href = "{{ route('backend.login') }}";
                    return;
                }
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

                    // BONUS: auto buka sidebar
                    let sidebar = new bootstrap.Offcanvas(document.getElementById('cartSidebar'));
                    sidebar.show();
                });

            });
        });

    });

    // =======================

    function loadCart() {
        fetch('/cart/data')
        .then(res => res.json())
        .then(data => {
            let html = '';
            let totalQty = 0;
            let total = 0;

            if (Object.keys(data).length === 0) {
                html = '<p>Belum ada barang</p>';
            } else {
                for (let id in data) {
                    let item = data[id];
                    let subtotal = item.price * item.qty;

                    total += subtotal;
                    totalQty += item.qty;

                    html += `
                        <div class="d-flex mb-3">
                            <img src="${item.image}" width="60" height="60" class="me-2 rounded-circle">
                            <div>
                                <h6>${item.name}</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQty(${id}, 'minus')">-</button>
                                    <span>${item.qty}</span>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQty(${id}, 'plus')">+</button>
                                </div>
                                <p class="mb-0">Rp ${item.price}</p>
                                <strong>Rp ${subtotal}</strong>
                            </div>
                            <button onclick="removeItem(${id})" class="btn btn-sm btn-danger ms-auto">🗑</button>
                        </div>
                    `;
                }

                html += `
                    <hr>
                    <div class="card p-3 mb-2 shadow-sm">
                        <h6 class="fw-bold mb-3">Informasi Pengiriman</h6>
                        <!-- Baris 1: Provinsi & Kota -->
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <label class="small fw-semibold">Provinsi Tujuan</label>
                                <select id="province" class="form-select form-select-sm" onchange="loadCities(this.value)">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold">Kota Tujuan</label>
                                <select id="city" class="form-select form-select-sm">
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                        <!-- Baris 2: Kurir & Alamat -->
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="small fw-semibold">Kurir</label>
                                <select id="courier" class="form-select form-select-sm">
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-semibold">Alamat Lengkap</label>
                                <textarea id="alamat" class="form-control form-control-sm" rows="1" placeholder="Nama jalan, RT/RW"></textarea>
                            </div>
                        </div>
                        <button onclick="cekOngkir(${total})" class="btn btn-black bg-primary text-white btn-sm w-100 fw-bold">
                            Cek Biaya Ongkir
                        </button>
                        <div id="ongkir-result" class="mt-2"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5 class="mb-0">Grand Total:</h5>
                        <h5 class="fw-bold text-pink">Rp <span id="total">${total}</span></h5>
                    </div>
                    <button class="btn btn-success w-100 mt-3 py-2 fw-bold btn-checkout">Checkout Sekarang</button>
                `;
                document.getElementById('cartContent').innerHTML = html;
                loadProvinces();
            }
            document.getElementById('cart-count').innerText = totalQty;
            
            document.querySelectorAll('.btn-checkout').forEach(btn => {
                btn.addEventListener('click', checkout);
            });
        });
    }

    // =======================

    function removeItem(id) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        }).then(() => loadCart());
    }

    function updateQty(id, action) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: id,
                action: action
            })
        }).then(() => loadCart());
    }

    function checkout() {
        if (!isLoggedIn) {
            alert('Silakan login terlebih dahulu!');
            window.location.href = "{{ route('backend.login') }}";
            return;
        }

        let provinceEl = document.getElementById('province');
        let cityEl = document.getElementById('city');
        let courierEl = document.getElementById('courier');

        let alamat = document.getElementById('alamat').value;


        if (!alamat || !province || !city) {
            alert("Lengkapi alamat dulu!");
            return;
        }

        fetch('/checkout', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                ongkir: selectedOngkir,
                alamat: alamat,
                province: provinceEl.options[provinceEl.selectedIndex].text, // 🔥 kirim nama provinsi
                city: cityEl.options[cityEl.selectedIndex].text, // 🔥 kirim nama kota
                courier: courierEl.value // 🔥 kirim nama kurir
            })
        })
        .then(res => {
            // kalau redirect (belum login), stop
            if (!res.ok) {
                throw new Error('Harus login');
            }
            return res.json();
        })
        .then(data => {
            window.snap.pay(data.snap_token, {
                onSuccess: function(result) {
                fetch('/cart/clear', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                // redirect ke halaman sukses
                window.location.href = "/checkout/success/" + result.order_id;
            },
            onPending: function(result) {
                console.log(result);
            },
            onError: function(result) {
                console.log(result);
                alert("Pembayaran gagal!");
            },
            onClose: function() {
                console.log('User menutup popup tanpa bayar');
            }
            });
        })
        .catch(() => {
            window.location.href = "{{ route('backend.login') }}";
        });
    }
    function cekOngkir(totalBarang) {
        let city = document.getElementById('city').value;
        let courier = document.getElementById('courier').value;

        console.log("REQUEST:", city, courier);

        fetch('/cek-ongkir', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ city, courier })
        })
        .then(async res => {
            console.log("STATUS:", res.status);

            let text = await res.text(); // 🔥 ambil raw response dulu

            try {
                return JSON.parse(text); // coba parse ke JSON
            } catch (e) {
                console.error("Bukan JSON:", text);
                throw new Error("Response bukan JSON (server error)");
            }
        })
        .then(data => {
            console.log("RESPONSE:", data);

            // 🔥 HANDLE ERROR DARI BACKEND
            if (data.error) {
                alert("ERROR: " + data.error);
                return;
            }

            if (!Array.isArray(data) || data.length === 0) {
                alert("Ongkir tidak tersedia");
                return;
            }

            let html = '';

            data.forEach(item => {
                if (!item.cost || item.cost.length === 0) return;

                let harga = item.cost;
                let etd = item.etd;

                html += `
                    <div class="border p-2 mb-2 rounded">
                        <b>${item.service}</b><br>
                        Rp ${harga} (${etd} hari)
                        <button onclick="pilihOngkir(${harga}, ${totalBarang})" 
                            class="btn btn-sm btn-success float-end">
                            Pilih
                        </button>
                    </div>
                `;
            });

            document.getElementById('ongkir-result').innerHTML = html;
        })
        .catch(err => {
            console.error("FETCH ERROR:", err);
            alert("Gagal ambil ongkir! Cek koneksi / API");
        });
    }

    function loadProvinces() {
        setTimeout(() => {
            let select = document.getElementById('province');

            if (!select) {
                console.error("Dropdown province TIDAK ditemukan!");
                return;
            }

            fetch('/get-provinces')
                .then(res => res.json())
                .then(data => {
                    console.log("PROVINCES:", data);

                    if (!Array.isArray(data)) return;

                    let opt = '<option value="">Pilih Provinsi</option>';

                    data.forEach(p => {
                        // 🔥 FIX DI SINI
                        opt += `<option value="${p.id}">${p.name}</option>`;
                    });

                    select.innerHTML = opt;
                })
                .catch(err => {
                    console.error("Gagal load provinces:", err);
                });

        }, 300);
    }

    function loadCities(provinceId) {
        if (!provinceId) return;
        console.log("PROVINCE ID:", provinceId);
        fetch(`/get-cities/${provinceId}`)
            .then(res => res.json())
            .then(data => {
                console.log("CITIES:", data);
                if (!Array.isArray(data)) return;
                let opt = '<option value="">Pilih Kota</option>';
                data.forEach(c => {
                    // 🔥 FIX DI SINI
                    opt += `<option value="${c.id}">${c.name}</option>`;
                });
                document.getElementById('city').innerHTML = opt;
            })
            .catch(err => {
                console.error("Gagal load cities:", err);
            });
    }


    function pilihOngkir(ongkir, totalBarang) {
        selectedOngkir = ongkir;
        let total = parseInt(totalBarang) + parseInt(ongkir);
        document.getElementById('total').innerText = total.toLocaleString('id-ID');
        document.getElementById('ongkir-result').innerHTML += `
            <div class="alert alert-success mt-2 p-2 small">
                <i class="bi bi-check-circle-fill"></i> Ongkir dipilih: <b>Rp ${ongkir.toLocaleString('id-ID')}</b>
            </div>
        `;
    }
    // load awal
    loadCart();
</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
data-client-key="SB-Mid-client-2Qab9asBGixDn0UK"></script>



</body>
</html>