<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeautyCare</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>
  <link
            rel="icon"
            type="img/png"
            href="{{ asset('img/beautycare.png') }}"
        />
  <style>

    body {
      background-color: #f9f9f9;
    }
    .bg-pink {
        background-color: #f98fae !important; /* pink pastel */
    }
    .custom-btn:hover {
        background-color: #FFBBE1 !important; /* Merah lebih gelap */
        color: black !important;
        border-radius: 7px;
    }
    .nav-link.active {
        background-color: #FFBBE1;
        color: black !important;
        border-radius: 7px;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row min-vh-100">
    <!-- Sidebar -->
    <nav class="col-md-4 col-lg-2 d-md-block bg-pink sidebar collapse pt-4">
      <div class="position-sticky p-2">
        <!-- <h4 class="text-center fs-2 text-white fw-bold mb-4">Beauty Care</h4> -->
         <div class="text-center mb-4">
            <img src="{{ asset('img/beautycare.png') }}" 
                width="160" 
                class="img-fluid" 
                alt="Logo">
        </div>
        <hr class="border-light border-2 opacity-75 mx-1">
        <ul class="nav flex-column">
          <li class="nav-item mt-3">
            <a class="{{ request()->routeIs('backend.beranda') ? 'active' : '' }} nav-link d-flex align-items-center text-white fs-5 fw-bold custom-btn" href="{{ route('backend.beranda') }}"><i data-feather="home" class="me-2"></i>Beranda</a>
          </li>
          <li class="nav-item mt-3">
            <a class="{{ request()->routeIs('backend.user.*') ? 'active' : '' }} nav-link d-flex align-items-center text-white fs-5 fw-bold custom-btn" href=" {{ route('backend.user.index') }} "><i data-feather="user" class="me-2 align-items-center"></i>Data Admin</a>
          </li>
          <li class="nav-item mt-3">
            <a class="{{ request()->routeIs('backend.supplier.*') ? 'active' : '' }} nav-link d-flex align-items-center text-white fs-5 fw-bold custom-btn" href=" {{ route('backend.supplier.index') }} "><i data-feather="truck" class="me-2 align-items-center"></i>Supplier</a>
          </li>
          <li class="nav-item mt-3">
            <a class="{{ request()->routeIs('backend.masuk.*') ? 'active' : '' }} nav-link d-flex align-items-center text-white fs-5 fw-bold custom-btn" href=" {{ route('backend.masuk.index') }} "><i data-feather="log-in" class="me-2 align-items-center"></i>Barang Masuk</a>
          </li>
          <li class="nav-item mt-3">
            <a class="{{ request()->routeIs('backend.keluar.*') ? 'active' : '' }} nav-link d-flex align-items-center text-white fs-5 fw-bold custom-btn" href=" {{ route('backend.keluar.index') }} "><i data-feather="log-out" class="me-2 align-items-center"></i>Barang Keluar</a>
          </li>
          <li class="nav-item mt-3">
            <a class="nav-link d-flex align-items-center text-white fs-5 fw-bold custom-btn" data-bs-toggle="collapse"  href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
              Data produk<i data-feather="chevron-right" class="align-items-center ms-5"></i>
            </a>
            <ul class="collapse pt-2 nav flex-column" id="collapseExample">
              <li class="nav-item"><a class="nav-link fw-medium text-white" href=" {{ route('backend.kategori.index') }} "><i data-feather="chevron-right" class="align-items-center me-1"></i>Kategori</a></li>
              <li class="nav-item"><a class="nav-link fw-medium text-white" href=" {{ route('backend.produk.index') }} "><i data-feather="chevron-right" class="align-items-center me-1"></i>Produk</a></li>
            </ul>
          </li>
          <li class="nav-item mt-3">
            <a class="nav-link text-center text-white btn fs-6 fw-bold" style="background-color: crimson;" href="#"
               onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
              Keluar
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 py-4">
      @yield('content')
    </main>
  </div>
</div>

<!-- Form Logout -->
<form action="{{ route('backend.logout') }}" id="keluar-app" method="post" class="d-none">
  @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      feather.replace();
    </script>
</body>
</html>