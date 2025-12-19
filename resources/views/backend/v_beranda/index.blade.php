@extends('backend.v_layouts.app')
@section('content')

<style>
    .text-pink { color: #f98fae; }
    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
    }
</style>

<div class="container mt-3 mx-auto">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body d-flex align-items-center gap-3 ms-4">

      {{-- FOTO USER DARI STORAGE --}}
      <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}"
           alt="User Photo"
           class="profile-img shadow-sm">

      {{-- TEKS SELAMAT DATANG --}}
      <div>
        <h3 class="fw-bold text-pink mb-2">{{ $judul }}</h3>
        <p class="mb-0">
          Selamat Datang,
          <b>{{ Auth::user()->nama }}</b>
          pada aplikasi <b>BeautyCare</b> dengan hak akses sebagai anda
          <b>
            @if (Auth::user()->role == 1)
              Admin
            @else
              Staff
            @endif
          </b>.
        </p>
        <small class="text-muted">Ini adalah halaman utama dari aplikasi ini.</small>
      </div>

    </div>
  </div>
</div>


<div class="container mt-5">
    <div class="row g-4">
        <!-- Stok Produk -->
        <div class="col-6 col-md-3">
            <div class="shadow-sm p-3 text-dark"
                 style="background:#e884a3; border-radius: 10px; height:200px; position:relative;">
                <span class="fw-bold" style="font-size:18px; position:absolute; top:15px; left:30px;">Stok Produk</span>
                <h2 class="fw-bold text-center"
                  style="margin-top:63px; font-size:50px;">
                  {{ $totalStok }}<span class="fs-6 ms-0">Pcs</span>
                </h2>
            </div>
        </div>

        <!-- Barang Masuk -->
        <div class="col-6 col-md-3">
            <div class="shadow-sm p-3 text-dark"
                 style="background:#f3b5c7; border-radius: 10px; height:200px; position:relative;">
                <span class="fw-bold" style="font-size:18px; position:absolute; top:15px; left:30px;">Barang Masuk</span>
                <h2 class="fw-bold text-center"
                  style="margin-top:63px; font-size:50px;">
                  {{ $totalMasuk }}<span class="fs-6 ms-0">Pcs</span>
                </h2>
            </div>
        </div>

        <!-- Barang Keluar -->
        <div class="col-6 col-md-3">
            <div class="shadow-sm p-3 text-dark"
                 style="background:#f8cddd; border-radius: 10px; height:200px; position:relative;">
                <span class="fw-bold" style="font-size:18px; position:absolute; top:15px; left:30px;">Barang Keluar</span>
                <h2 class="fw-bold text-center"
                  style="margin-top:63px; font-size:50px;">
                  {{ $totalKeluar }}<span class="fs-6 ms-0">Pcs</span>
                </h2>
            </div>
        </div>

        <!-- Produk Sedikit -->
        <div class="col-6 col-md-3">
            <div class="shadow-sm p-3 text-light"
                 style="background:#a83a69; border-radius: 10px; height:200px; position:relative;">
                <span class="fw-bold" style="font-size:18px; position:absolute; top:15px; left:15px;">Produk Sedikit</span>
                <h2 class="fw-bold text-center"
                  style="margin-top:70px; font-size:23px;">
                  {{ $produkSedikit->nama_produk ?? 'Tidak ada data' }}
                </h2>
                <p class="text-center fst-italic fs-6">Stok {{$produkSedikit->stok}}</p>
            </div>
        </div>

    </div>
</div>


<div class="container">
  <h4 class="mb-3 mt-5 fw-bold"><i data-feather="bar-chart" class="me-2 align-items-center"></i>Grafik Barang Masuk & Keluar</h4>
  <canvas id="grafikMasukKeluar" height="90"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const labels = @json(array_keys($masuk));
    const data = {
          labels: labels,
          datasets: [
              {
                  label: 'Barang Masuk',
                  data: @json(array_values($masuk)),
                  backgroundColor: 'rgba(0,123,255,0.6)'
              },
              {
                  label: 'Barang Keluar',
                  data: @json(array_values($keluar)),
                  backgroundColor: 'rgba(255,0,0,0.6)'
              }
          ]
      };

    const config = {
          type: 'bar',
          data: data,
          options: {
              responsive: true,
              plugins: {
                  legend: { position: 'top' },
                  title: { display: true, text: 'Grafik Barang Masuk & Keluar per Bulan' }
              }
          }
      };

    console.log(labels, @json(array_values($masuk)), @json(array_values($keluar)));
    new Chart(
          document.getElementById('grafikMasukKeluar'),
          config
      );
</script>
</div>

<div class="container table-responsive mt-5 mb-3">
  <h4 class="fw-bold mb-5"><i data-feather="clock" class="me-2 align-items-center"></i>Tiga Produk Mendekati Kadaluarsa</h4>
  <table class="table table-striped align-middle text-center">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Tanggal Kadaluarsa</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($produk as $index => $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama_produk }}</td>
          <td>{{ \Carbon\Carbon::parse($p->kadaluarsa)->format('d-m-Y') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3">Tidak ada produk mendekati kadaluarsa</td>
        </tr>
        @endforelse
      </tbody>
  </table>
</div>

@endsection
