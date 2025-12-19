@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->

<style>
  .text-pink {
    color: #f98fae;
  }
  .btn-pink {
    background-color: #f98fae;
    color: #fff;
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
        <form class="form-horizontal" action="{{ route('backend.user.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body p-4">
            <h4 class="card-title text-pink mb-4 fw-bold">{{ $judul }}</h4>
            <div class="row d-flex flex-column">
              <div class="col">
                <div class="form-group">
                  <label class="fw-bold mb-2">Foto</label>
                  <img class="foto-preview">
                  <input 
                    type="file" 
                    name="foto" 
                    class="form-control @error('foto') is-invalid @enderror" 
                    onchange="previewFoto()">
                  @error('foto')
                    <div class="invalid-feedback alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Hak Akses</label>
                  <select name="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Pilih Hak Akses -</option>
                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Staff</option>
                  </select>
                  @error('role')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mt-3 mb-2">
                  <label class="fw-bold">Nama</label>
                  <input 
                    type="text" 
                    name="nama" 
                    value="{{ old('nama') }}" 
                    class="form-control @error('nama') is-invalid @enderror" 
                    placeholder="Masukkan Nama" class="text-danger">
                  @error('nama')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Email</label>
                  <input 
                    type="text" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Masukkan Email">
                  @error('email')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">HP</label>
                  <input 
                    type="text" 
                    onkeypress="return hanyaAngka(event)" 
                    name="hp" 
                    value="{{ old('hp') }}" 
                    class="form-control @error('hp') is-invalid @enderror" 
                    placeholder="Masukkan Nomor HP">
                  @error('hp')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Password</label>
                  <input 
                    type="text" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Masukkan Password">
                  @error('password')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3 mb-2">
                  <label class="fw-bold">Konfirmasi Password</label>
                  <input 
                    type="text" 
                    name="password_confirmation" 
                    class="form-control" 
                    placeholder="Konfirmasi Password">
                </div>
              </div>
            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold text-white">Simpan</button>
              <a href="{{ route('backend.user.index') }}">
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
