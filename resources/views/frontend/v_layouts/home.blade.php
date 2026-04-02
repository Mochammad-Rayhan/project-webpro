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
        .bg-pink {
        background-color: #f98fae !important; /* pink pastel */
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
                    <a class="nav-link text-white fs-5 ms-4" href="#">About Us</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#">Produk</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#">Testimoni</a>
                    <a class="nav-link text-white fs-5 ms-4" href="#">Contact</a>
                </div>

                <!-- KANAN (Button Login) -->
                <div>
                    <a href="{{ route('backend.login') }}" class="btn btn-light fw-semibold">Login</a>
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
                 @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="produk">
                            <div class="card-body text-start">
                                <h5 class="fw-bold fs-4">{{ $product->nama_produk }}</h5>
                                <p class="text-muted small">{{ Str::limit($product->description, 130) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-semibold">Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}</p>
                                    <p class="text-black py-1 px-4 text-white rounded-pill bg-pink fw-semibold">{{ $product->kategori->nama_kategori }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="section-padding" style="background-color: #fddae4;">
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
    <section class="section-padding">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="fw-bold">Featured Products</h3>
            <a href="#" class="btn bg-pink text-white btn-sm">See All Products</a>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-5">
                    <div class="card border-0 shadow-sm h-200">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="produk">
                            <div class="card-body text-start">
                                <h5 class="fw-bold fs-4 mb-2">{{ $product->nama_produk }}</h5>
                                <p class="fw-semibold">Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}</p>
                                <p class="text-muted small mb-0">{{ Str::limit($product->description, 100) }}</p>
                                <!-- <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-black py-0.8 px-3 mb-4 text-white rounded-pill d-inline-block bg-pink">{{ $product->kategori->nama_kategori }}</p>
                                </div> -->
                            </div>
                            <div class="d-flex gap-2 p-3">
                                <!-- Detail kecil -->
                                <button class="btn btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <!-- Cart besar -->
                                <form action="#" method="POST" class="flex-grow-1">
                                    @csrf
                                    <button class="btn bg-pink text-white w-100 fw-semibold">
                                        + Add to Cart
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>