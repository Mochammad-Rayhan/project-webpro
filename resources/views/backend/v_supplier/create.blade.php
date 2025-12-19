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
              action="{{ route('backend.supplier.store') }}" 
              method="post">
          @csrf

          <div class="card-body p-4">
            <h4 class="card-title text-pink mb-4 fw-bold">{{ $judul }}</h4>

            <div class="row d-flex flex-column">

              {{-- Input Kode Supplier --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Kode Supplier</label>
                  <input 
                    type="text" 
                    name="kode_supplier" 
                    value="{{ old('kode_supplier') }}" 
                    class="form-control @error('kode_supplier') is-invalid @enderror" 
                    placeholder="Masukkan Kode Supplier">

                  @error('kode_supplier')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Nama Supplier --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Nama Supplier</label>
                  <input 
                    type="text" 
                    name="nama_supplier" 
                    value="{{ old('nama_supplier') }}" 
                    class="form-control @error('nama_supplier') is-invalid @enderror" 
                    placeholder="Masukkan Nama Kategori">

                  @error('nama_supplier')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Nomor HP --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Nomor HP</label>
                  <input 
                    type="text" 
                    name="no_hp" 
                    value="{{ old('no_hp') }}" 
                    class="form-control @error('no_hp') is-invalid @enderror" 
                    placeholder="Masukkan Nama Kategori">

                  @error('no_hp')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Alamat Supplier --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Alamat Supplier</label>
                  <input 
                    type="text" 
                    name="alamat" 
                    value="{{ old('alamat') }}" 
                    class="form-control @error('alamat') is-invalid @enderror" 
                    placeholder="Masukkan Nama Kategori">

                  @error('alamat')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold">Simpan</button>

              <a href="{{ route('backend.supplier.index') }}">
                <button type="button" class="btn btn-secondary fw-bold">Kembali</button>
              </a>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- contentAkhir -->
@endsection
