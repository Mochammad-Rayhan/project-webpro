@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->

<style>
  .text-pink {
    color: #f98fae;
  }
  .btn-pink {
    background-color: #f98fae;
    color: white;
    border: none;
  }
  .btn-pink:hover {
    background-color: #d63384;
    color: #fff;
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">

        <form class="form-horizontal" 
              action="{{ route('backend.keluar.update' , $edit->id) }}" 
              method="post">
          @csrf
          @method('put')

          <div class="card-body p-4">
            <h4 class="card-title text-pink mb-4 fw-bold">{{ $judul }}</h4>
            <div class="row d-flex flex-column">

              {{-- Input Produk --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Nama Produk</label>
                  <select name="id_produk" class="form-control @error('role') is-invalid @enderror">
                    <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Nama Produk -</option>
                    @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}" {{ old('id_produk', $edit->id_produk) == $p->id_produk ? 'selected' : '' }}>{{ $p->nama_produk }}</option>
                    @endforeach
                  </select>
                  @error('id_produk')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              

              {{-- Input Admin --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Nama admin</label>
                  <select name="id_admin" class="form-control @error('role') is-invalid @enderror">
                    <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Nama Admin -</option>
                    @foreach ($user as $u)
                    <option value="{{ $u->id_admin }}" {{ old('id_admin', $edit->id_admin) == $u->id_admin ? 'selected' : '' }}>{{ $u->nama }}</option>
                    @endforeach
                  </select>
                  @error('id_admin')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Jumlah keluar --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Jumlah Keluar Barang</label>
                  <input 
                    type="number" 
                    name="jumlah_keluar" 
                    value="{{ old('jumlah_keluar' , $edit->jumlah_keluar) }}" 
                    class="form-control @error('jumlah_keluar') is-invalid @enderror" 
                    placeholder="Masukkan jumlah barang keluar">

                  @error('jumlah_keluar')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Harga Jual --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Harga Jual Barang</label>
                  <input 
                    type="number" 
                    name="harga_jual" 
                    value="{{ old('harga_jual' , $edit->harga_jual) }}"  
                    class="form-control @error('harga_jual') is-invalid @enderror" 
                    placeholder="Masukkan harga jual barang">

                  @error('harga_jual')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input total_Keluar --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Total Penjualan</label>
                  <input 
                    type="number" 
                    name="total_keluar" 
                    id="total_keluar"
                    value="{{ old('total_keluar' , $edit->total_keluar) }}" 
                    readonly 
                    class="form-control @error('total_keluar') is-invalid @enderror" 
                    placeholder="total pendapatan">

                  @error('total_keluar')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input tanggal Keluar --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Tanggal Keluar Barang</label>
                  <input 
                    type="date" 
                    name="tanggal_keluar" 
                    value="{{ old('tanggal_keluar' , $edit->tanggal_keluar) }}" 
                    class="form-control @error('tanggal_keluar') is-invalid @enderror" 
                    placeholder="Masukkan tanggal masuk barang">

                  @error('tanggal_keluar')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input tanggal keterangan --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Keterangan</label>
                  <input 
                    type="text" 
                    name="keterangan" 
                    value="{{ old('keterangan' , $edit->keterangan) }}" 
                    class="form-control @error('keterangan') is-invalid @enderror" 
                    placeholder="Masukkan Keterangan">

                  @error('keterangan')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold">Perbarui</button>

              <a href="{{ route('backend.keluar.index') }}">
                <button type="button" class="btn btn-secondary fw-bold">Kembali</button>
              </a>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script>
    const jumlah = document.querySelector('input[name="jumlah_keluar"]');
    const harga = document.querySelector('input[name="harga_jual"]');
    const total = document.getElementById('total_keluar');

    function hitungTotal() {
        const j = Number(jumlah.value) || 0;
        const h = Number(harga.value) || 0;
        total.value = j * h;
    }

    jumlah.addEventListener('input', hitungTotal);
    harga.addEventListener('input', hitungTotal);
</script>

<!-- contentAkhir -->
@endsection
