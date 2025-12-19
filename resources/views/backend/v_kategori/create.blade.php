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
              action="{{ route('backend.kategori.store') }}" 
              method="post">
          @csrf

          <div class="card-body p-4">
            <h4 class="card-title text-pink mb-4 fw-bold">{{ $judul }}</h4>

            <div class="row d-flex flex-column">

              {{-- Input Kode --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Kode</label>
                  <input 
                    type="text" 
                    name="kode" 
                    value="{{ old('kode') }}" 
                    class="form-control @error('kode') is-invalid @enderror" 
                    placeholder="Masukkan Kode Kategori">

                  @error('kode')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              {{-- Input Nama Kategori --}}
              <div class="col">
                <div class="form-group mb-3">
                  <label class="fw-bold mb-2">Nama Kategori</label>
                  <input 
                    type="text" 
                    name="nama_kategori" 
                    value="{{ old('nama_kategori') }}" 
                    class="form-control @error('nama_kategori') is-invalid @enderror" 
                    placeholder="Masukkan Nama Kategori">

                  @error('nama_kategori')
                    <span class="invalid-feedback alert-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold">Simpan</button>

              <a href="{{ route('backend.kategori.index') }}">
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
