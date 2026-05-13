@php
use Illuminate\Support\Str;
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautycare</title>
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
        .testi-modern {
            position: relative;
            border-radius: 20px;
            height: 320px;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .testi-img {
            position: absolute;
            top: 0;
            right: 0;
            width: 70%;
            height: 100%;
            object-fit: cover;
        }

        .testi-box {
            position: relative;
            background: white;
            padding: 15px;
            border-radius: 15px;
            text-align: left;
            max-width: 80%;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
                /* TESTIMONI STYLE */
        .testimonial-section {
            background: #f5f5f5;
            overflow: hidden;
        }

        .testimonial-wrapper {
            position: relative;
            margin-top: 70px;
        }

        .testimonial-box {
            background: white;
            border-radius: 20px;
            padding: 25px;
            position: relative;
            transition: 0.3s;
            height: 100%;
        }

        .testimonial-box:hover {
            transform: translateY(-5px);
        }

        .testimonial-box.large {
            padding: 40px 30px;
        }

        .testimonial-avatar {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #f5f5f5;
            position: absolute;
            top: -35px;
            left: 25px;
            background: white;
        }

        .testimonial-avatar.center {
            left: 50%;
            transform: translateX(-50%);
        }

        .testimonial-stars {
            color: #ffc107;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .testimonial-text {
            color: #666;
            line-height: 1.8;
            font-size: 14px;
            margin-top: 20px;
        }

        .testimonial-name {
            color: #6b4a3a;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 0;
        }

        .testimonial-role {
            font-size: 12px;
            color: #999;
        }

        .quote-icon {
            position: absolute;
            right: 20px;
            bottom: 10px;
            font-size: 70px;
            color: #f1f1f1;
            line-height: 1;
        }

        .testimonial-mini {
            min-height: 180px;
        }

        .testimonial-large {
            min-height: 320px;
        }

        .testimonial-bubble::after {
            content: "";
            width: 25px;
            height: 25px;
            background: white;
            position: absolute;
            bottom: -10px;
            left: 40px;
            transform: rotate(45deg);
        }

        @media(max-width: 768px){
            .testimonial-box {
                margin-bottom: 60px;
            }

            .testimonial-large {
                min-height: auto;
            }
        }

        /* CONTACT SECTION */
        .contact-section {
            background: #f7f7f7;
            position: relative;
            overflow: hidden;
        }

        .contact-badge {
            display: inline-block;
            background: #fff;
            color: #ff6b81;
            font-size: 12px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .contact-title {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.2;
            color: #1d1d1d;
        }

        .contact-title span {
            color: #ff6b81;
        }

        .contact-form .form-control {
            border: none;
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 18px;
            font-size: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .contact-form textarea {
            min-height: 160px;
            resize: none;
        }

        .contact-btn {
            background: linear-gradient(90deg, #ff6b81, #ff9f9f);
            border: none;
            color: white;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: .3s;
        }

        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255,107,129,0.3);
        }

        .contact-image {
            position: relative;
            z-index: 2;
        }

        .contact-image img {
            max-height: 600px;
            object-fit: contain;
        }

        .live-chat-card {
            position: absolute;
            left: 20px;
            bottom: 80px;
            width: 220px;
            background: linear-gradient(180deg, #ff5b5b, #ff7c7c);
            padding: 30px 20px;
            border-radius: 28px;
            color: white;
            z-index: 3;
            box-shadow: 0 20px 30px rgba(255,91,91,0.3);
        }

        .live-chat-card i {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .live-chat-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .live-chat-card p {
            font-size: 13px;
            opacity: .9;
            line-height: 1.7;
        }

        .live-chat-btn {
            background: white;
            color: #ff5b5b;
            border-radius: 50px;
            padding: 10px 20px;
            display: inline-block;
            font-weight: 700;
            font-size: 13px;
            margin-top: 10px;
            text-decoration: none;
        }

        .contact-map {
            margin-top: -80px;
            position: relative;
            z-index: 1;
        }

        .contact-map iframe {
            width: 100%;
            height: 300px;
            border: 0;
            border-radius: 30px;
        }

        @media(max-width: 992px){

            .contact-title {
                font-size: 36px;
            }

            .live-chat-card {
                position: relative;
                left: 0;
                bottom: 0;
                margin: 30px auto;
            }

            .contact-image {
                text-align: center;
            }

            .contact-map {
                margin-top: 40px;
            }
        }

        /* ===== CART MODERN ===== */
            .cart-item {
                display: flex;
                gap: 12px;
                background: #fff;
                padding: 12px;
                border-radius: 18px;
                margin-bottom: 12px;
                align-items: center;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                transition: .2s;
            }

            .cart-item:hover {
                transform: scale(1.02);
            }

            .cart-img {
                width: 65px;
                height: 65px;
                border-radius: 12px;
                object-fit: cover;
            }

            /* QTY BUTTON */
            .cart-btn {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                border: none;
                background: #ffe4ec;
                color: #ff5f8f;
                font-weight: bold;
            }

            .cart-btn:hover {
                background: #ff5f8f;
                color: white;
            }

            /* REMOVE */
            .cart-remove {
                border: 2px solid #ff5f8f;
                background: transparent;
                color: #ff5f8f;
                border-radius: 50%;
                width: 30px;
                height: 30px;
            }

            .cart-remove:hover {
                background: #ff5f8f;
                color: white;
            }

            /* CHECKOUT */
            .btn-checkout {
                background: linear-gradient(135deg,#ff8fb1,#ff5f8f);
                border: none;
                color: white;
                border-radius: 50px;
                font-weight: 600;
            }

            .btn-checkout:hover {
                transform: scale(1.05);
            }

            /* ADD TO CART BUTTON PRODUK */
            .add-to-cart {
                border-radius: 50px !important;
                background: linear-gradient(135deg,#ff8fb1,#ff5f8f) !important;
                border: none !important;
            }

            .add-to-cart:hover {
                transform: scale(1.05);
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
                Produk paling laris manis banget
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
                            <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="card-img-top" alt="produk">
                            {{-- <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="produk"> --}}
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
            <a href="{{ route('produk.list') }}" class="btn bg-pink text-white btn-sm">
                See All Products
            </a>
        </div>
        <div class="row">
            @foreach ($produkTerbaru as $item)
                <div class="col-md-3 mb-5">
                    <div class="card border-0 shadow-sm h-200">
                        <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="card-img-top" alt="produk">
                        {{-- <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="produk"> --}}
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
                                    data-image="{{ Str::startsWith($item->image, 'http') 
                                        ? $item->image 
                                        : asset('storage/' . $item->image) }}"
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

    <!-- TESTIMONI -->
    <section class="section-padding testimonial-section" id="testimoni">
        <div class="container">

            <div class="text-center">
                <h2 class="fw-bold display-5" style="color: #6b4a3a;">
                    Apa Kata Mereka?
                </h2>

                <p class="text-muted mt-3">
                    Kepuasan pelanggan adalah prioritas utama kami 
                </p>
            </div>

            <div class="testimonial-wrapper">

                <div class="row g-4 align-items-center">

                    <!-- LEFT -->
                    <div class="col-lg-3">

                        <div class="testimonial-box testimonial-mini shadow-sm mb-4">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                class="testimonial-avatar">

                            <p class="testimonial-text mt-5">
                                Produk skincare di sini asli semua dan cocok banget di kulit aku
                            </p>

                            <h6 class="testimonial-name">James Riyan</h6>
                            <small class="testimonial-role">Customer</small>
                        </div>

                        <div class="testimonial-box testimonial-bubble shadow-sm">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                class="testimonial-avatar">

                            <div class="testimonial-stars mt-5">
                                ★★★★★
                            </div>

                            <h4 class="fw-bold mt-3" style="color:#6b4a3a;">
                                I really appreciate!!
                            </h4>

                            <p class="testimonial-text">
                                Pengiriman cepat, packaging aman, dan kualitas produknya premium banget
                            </p>

                            <h6 class="testimonial-name">Hilda Evelyn</h6>
                            <small class="testimonial-role">Beauty Enthusiast</small>

                            <div class="quote-icon">”</div>
                        </div>

                    </div>

                    <!-- CENTER -->
                    <div class="col-lg-3">

                        <div class="testimonial-box testimonial-large shadow-sm text-center">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg"
                                class="testimonial-avatar center">

                            <div class="mt-5">
                                <img src="https://i.pinimg.com/736x/32/ca/02/32ca02e298ecd0ee5f466efa439264f5.jpg"
                                    class="img-fluid rounded-4"
                                    style="height:250px; object-fit:cover;">
                            </div>

                            <p class="testimonial-text">
                                “Produk original dengan harga terjangkau dan bikin percaya diri meningkat ✨”
                            </p>
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-6">

                        <div class="row g-4">

                            <div class="col-md-12">
                                <div class="testimonial-box testimonial-mini shadow-sm">
                                    <img src="https://randomuser.me/api/portraits/women/21.jpg"
                                        class="testimonial-avatar">

                                    <h5 class="fw-bold mt-5" style="color:#6b4a3a;">
                                        Good Job!
                                    </h5>

                                    <p class="testimonial-text">
                                        Seneng banget nemu toko skincare terpercaya kayak gini 💖
                                    </p>

                                    <h6 class="testimonial-name">Salsa Putri</h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="testimonial-box shadow-sm">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg"
                                        class="testimonial-avatar">

                                    <p class="testimonial-text mt-5">
                                        “Fast respon dan produknya sesuai ekspektasi banget”
                                    </p>

                                    <h6 class="testimonial-name">Henry Vano</h6>
                                    <small class="testimonial-role">Customer</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="testimonial-box shadow-sm">
                                    <img src="https://randomuser.me/api/portraits/men/15.jpg"
                                        class="testimonial-avatar">

                                    <div class="testimonial-stars mt-5">
                                        ★★★★★
                                    </div>

                                    <p class="testimonial-text">
                                        Harga murah tapi kualitas gak murahan. Recommended banget!
                                    </p>

                                    <h6 class="testimonial-name">Basil Haliwand</h6>
                                    <small class="testimonial-role">Customer</small>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="section-padding" id="contact" style="background-color: #fddae4;">
        <div class="container">
            <h2 class="text-center fw-bold display-5 mb-4" style="color: #6b4a3a;">
                Hubungi Kami
            </h2>

            <div class="row">
                <!-- FORM -->
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label class="fw-semibold">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama">
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Pesan</label>
                            <textarea class="form-control" rows="4" placeholder="Tulis pesan..."></textarea>
                        </div>
                        <button class="btn bg-pink text-white w-100">Kirim Pesan</button>
                    </form>
                </div>

                <!-- INFO -->
                <div class="col-md-6">
                    <div class="p-4">
                        <h5 class="fw-bold mb-3">Info Kontak</h5>
                        <p><i class="bi bi-geo-alt"></i> Jakarta, Indonesia</p>
                        <p><i class="bi bi-envelope"></i> beautycare@gmail.com</p>
                        <p><i class="bi bi-telephone"></i> +62 812-3456-7890</p>

                        <h6 class="fw-bold mt-4">Follow Us</h6>
                        <div class="d-flex gap-3 mt-2">
                            <i class="bi bi-instagram fs-4"></i>
                            <i class="bi bi-facebook fs-4"></i>
                            <i class="bi bi-whatsapp fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
<!-- Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    let selectedOngkir = 0;

    // =========================
    // MODAL DETAIL PRODUK
    // =========================
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
        });
    });

    // =========================
    // ADD TO CART
    // =========================
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.add-to-cart').forEach(btn => {

            btn.addEventListener('click', function () {

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

                    let sidebar = new bootstrap.Offcanvas(
                        document.getElementById('cartSidebar')
                    );

                    sidebar.show();
                });

            });

        });

        loadCart();
    });

    // =========================
    // LOAD CART
    // =========================
    function loadCart() {

        fetch('/cart/data')
        .then(res => res.json())
        .then(data => {

            let html = '';
            let totalQty = 0;
            let total = 0;

            if (Object.keys(data).length === 0) {

                html = `
                    <div class="text-center py-5">
                        <i class="bi bi-cart-x fs-1 text-muted"></i>
                        <p class="mt-3 text-muted">Belum ada barang</p>
                    </div>
                `;

            } else {

                for (let id in data) {

                    let item = data[id];
                    let subtotal = item.price * item.qty;

                    total += subtotal;
                    totalQty += item.qty;

                    html += `
                        <div class="cart-item">

                            <img src="${item.image}" class="cart-img">

                            <div class="flex-grow-1">

                                <div class="fw-bold">
                                    ${item.name}
                                </div>

                                <div class="d-flex align-items-center gap-2 my-2">

                                    <button class="cart-btn"
                                        onclick="updateQty(${id}, 'minus')">
                                        -
                                    </button>

                                    <span>${item.qty}</span>

                                    <button class="cart-btn"
                                        onclick="updateQty(${id}, 'plus')">
                                        +
                                    </button>

                                </div>

                                <small class="text-muted">
                                    Rp ${parseInt(item.price).toLocaleString('id-ID')}
                                </small>

                                <br>

                                <strong>
                                    Rp ${subtotal.toLocaleString('id-ID')}
                                </strong>

                            </div>

                            <button onclick="removeItem(${id})"
                                class="cart-remove">

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>
                    `;
                }

                html += `
                    <hr>

                    <div class="card p-3 mb-3 shadow-sm border-0">

                        <h6 class="fw-bold mb-3">
                            Informasi Pengiriman
                        </h6>

                        <div class="row g-2 mb-2">

                            <div class="col-md-6">
                                <label class="small fw-semibold">
                                    Provinsi
                                </label>

                                <select id="province"
                                    class="form-select form-select-sm"
                                    onchange="loadCities(this.value)">

                                    <option value="">
                                        Pilih Provinsi
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6">

                                <label class="small fw-semibold">
                                    Kota
                                </label>

                                <select id="city"
                                    class="form-select form-select-sm">

                                    <option value="">
                                        Pilih Kota
                                    </option>

                                </select>
                            </div>

                        </div>

                        <div class="row g-2 mb-3">

                            <div class="col-md-6">

                                <label class="small fw-semibold">
                                    Kurir
                                </label>

                                <select id="courier"
                                    class="form-select form-select-sm">

                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>

                                </select>

                            </div>

                            <div class="col-md-6">

                                <label class="small fw-semibold">
                                    Alamat
                                </label>

                                <textarea id="alamat"
                                    class="form-control form-control-sm"
                                    rows="1"
                                    placeholder="Nama jalan, RT/RW"></textarea>

                            </div>

                        </div>

                        <button onclick="cekOngkir(${total})"
                            class="btn btn-danger btn-sm w-100 fw-bold">

                            Cek Ongkir

                        </button>

                        <div id="ongkir-result" class="mt-3"></div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">Grand Total</h5>

                        <h5 class="fw-bold text-danger">
                            Rp <span id="total">
                                ${total.toLocaleString('id-ID')}
                            </span>
                        </h5>

                    </div>

                    <button class="btn btn-checkout w-100 mt-3 py-2">
                        Checkout Sekarang
                    </button>
                `;
            }

            document.getElementById('cartContent').innerHTML = html;
            document.getElementById('cart-count').innerText = totalQty;

            if (Object.keys(data).length !== 0) {
                loadProvinces();
            }

            document.querySelectorAll('.btn-checkout').forEach(btn => {
                btn.addEventListener('click', checkout);
            });

        });
    }

    // =========================
    // REMOVE ITEM
    // =========================
    function removeItem(id) {

        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id })
        })
        .then(() => loadCart());
    }

    // =========================
    // UPDATE QTY
    // =========================
    function updateQty(id, action) {

        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id,
                action
            })
        })
        .then(() => loadCart());
    }

    // =========================
    // LOAD PROVINCES
    // =========================
    function loadProvinces() {

        fetch('/get-provinces')
        .then(res => res.json())
        .then(data => {

            let opt = `
                <option value="">
                    Pilih Provinsi
                </option>
            `;

            data.forEach(p => {
                opt += `
                    <option value="${p.id}">
                        ${p.name}
                    </option>
                `;
            });

            document.getElementById('province').innerHTML = opt;
        });
    }

    // =========================
    // LOAD CITIES
    // =========================
    function loadCities(provinceId) {

        if (!provinceId) return;

        fetch('/get-cities/' + provinceId)
        .then(res => res.json())
        .then(data => {

            let opt = `
                <option value="">
                    Pilih Kota
                </option>
            `;

            data.forEach(c => {
                opt += `
                    <option value="${c.id}">
                        ${c.name}
                    </option>
                `;
            });

            document.getElementById('city').innerHTML = opt;
        });
    }

    // =========================
    // CEK ONGKIR
    // =========================
    function cekOngkir(totalBarang) {

        let city = document.getElementById('city').value;
        let courier = document.getElementById('courier').value;

        if (!city) {
            alert('Pilih kota dulu!');
            return;
        }

        fetch('/cek-ongkir', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                city,
                courier
            })
        })
        .then(res => res.json())
        .then(data => {

            let html = '';

            if (!Array.isArray(data)) {
                alert('Ongkir tidak tersedia');
                return;
            }

            data.forEach(item => {

                html += `
                    <div class="border rounded p-2 mb-2">

                        <b>${item.service}</b>

                        <br>

                        Rp ${parseInt(item.cost).toLocaleString('id-ID')}
                        (${item.etd} hari)

                        <button
                            onclick="pilihOngkir(${item.cost}, ${totalBarang})"
                            class="btn btn-primary btn-sm float-end">

                            Pilih

                        </button>

                    </div>
                `;
            });

            document.getElementById('ongkir-result').innerHTML = html;
        });
    }

    // =========================
    // PILIH ONGKIR
    // =========================
    function pilihOngkir(ongkir, totalBarang) {

        selectedOngkir = ongkir;

        let total = parseInt(totalBarang) + parseInt(ongkir);

        document.getElementById('total').innerText =
            total.toLocaleString('id-ID');

        document.getElementById('ongkir-result').innerHTML += `
            <div class="alert alert-success mt-2 small">

                Ongkir dipilih:
                <b>
                    Rp ${ongkir.toLocaleString('id-ID')}
                </b>

            </div>
        `;
    }

    // =========================
    // CHECKOUT
    // =========================
    function checkout() {

        if (!isLoggedIn) {

            alert('Silakan login terlebih dahulu');

            window.location.href =
                "{{ route('backend.login') }}";

            return;
        }

        let provinceEl = document.getElementById('province');
        let cityEl = document.getElementById('city');
        let courierEl = document.getElementById('courier');

        let province = provinceEl.value;
        let city = cityEl.value;
        let alamat = document.getElementById('alamat').value;

        if (!province || !city || !alamat) {

            alert('Lengkapi alamat pengiriman!');

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

                province:
                    provinceEl.options[
                        provinceEl.selectedIndex
                    ].text,

                city:
                    cityEl.options[
                        cityEl.selectedIndex
                    ].text,

                courier: courierEl.value
            })
        })

        .then(res => res.json())

        .then(data => {

            window.snap.pay(data.snap_token, {

                onSuccess: function(result) {

                    fetch('/cart/clear', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    window.location.href =
                        "/checkout/success/" + result.order_id;
                },

                onPending: function(result) {
                    console.log(result);
                },

                onError: function(result) {
                    console.log(result);
                    alert('Pembayaran gagal!');
                },

                onClose: function() {
                    console.log('Popup ditutup');
                }

            });

        })

        .catch(err => {
            console.log(err);
            alert('Checkout gagal!');
        });
    }
</script>

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-2Qab9asBGixDn0UK">
</script>


@include('frontend.components.ai-chat')

</body>
</html>