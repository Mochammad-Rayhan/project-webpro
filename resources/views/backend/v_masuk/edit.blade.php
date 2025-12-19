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
              action="{{ route('backend.masuk.update' , $edit->id) }}" 
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

              {{-- Input Supplier --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Nama Supplier</label>
                  <select name="kode_supplier" class="form-control @error('role') is-invalid @enderror">
                    <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Nama Supplier -</option>
                    @foreach ($supplier as $s)
                    <option value="{{ $s->kode_supplier }}" {{ old('kode_supplier', $edit->kode_supplier) == $s->kode_supplier ? 'selected' : '' }}>{{ $s->nama_supplier }}</option>
                    @endforeach
                  </select>
                  @error('kode_supplier')
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

              {{-- Input Jumlah Masuk --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Jumlah Masuk Barang</label>
                  <input 
                    type="number" 
                    name="jumlah_masuk" 
                    value="{{ old('jumlah_masuk' , $edit->jumlah_masuk) }}" 
                    class="form-control @error('jumlah_masuk') is-invalid @enderror" 
                    placeholder="Masukkan Jumlah masuk barang">

                  @error('jumlah_masuk')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Harga Beli --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Harga Satuan Barang</label>
                  <input 
                    type="number" 
                    name="harga_beli" 
                    value="{{ old('harga_beli' , $edit->harga_beli) }}"  
                    class="form-control @error('harga_beli') is-invalid @enderror" 
                    placeholder="Masukkan harga satuan barang">

                  @error('harga_beli')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input total_masuk --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Total Pembeliaan</label>
                  <input 
                    type="number" 
                    name="total_masuk" 
                    id="total_masuk"
                    value="{{ old('total_masuk', $edit->total_masuk) }}"
                    readonly 
                    class="form-control @error('total_masuk') is-invalid @enderror" 
                    placeholder="total pembelian">

                  @error('total_masuk')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input tanggal Masuk --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Tanggal Masuk</label>
                  <input 
                    type="date" 
                    name="tanggal_masuk" 
                    value="{{ old('tanggal_masuk' , $edit->tanggal_masuk) }}" 
                    class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                    placeholder="Masukkan tanggal masuk barang">

                  @error('tanggal_masuk')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold">Perbarui</button>

              <a href="{{ route('backend.masuk.index') }}">
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
    const jumlah = document.querySelector('input[name="jumlah_masuk"]');
    const harga = document.querySelector('input[name="harga_beli"]');
    const total = document.getElementById('total_masuk');

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