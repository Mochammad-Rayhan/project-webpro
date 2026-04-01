<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautycare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .bg-pink {
        background-color: #f98fae !important; /* pink pastel */
    }
    </style>
</head>
<body>
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg py-2 bg-pink">
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
            <h2 class="fw-bold display-5">
                Best Seller Product
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
                                <p class="text-muted small">{{ Str::limit($product->description, 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-semibold">Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}</p>
                                    <p class="text-muted small">{{ $product->kategori->nama_kategori }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="section-padding" style="background-color: #FFBBE1;">
        <h1 class="text-center text-white fw-bold">About Us</h1>
    </section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>