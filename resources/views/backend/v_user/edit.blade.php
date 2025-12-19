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
        <form class="form-horizontal" action="{{ route('backend.user.update', $edit->id_admin) }}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="card-body p-4">
            <h4 class="card-title text-pink mb-4 fw-bold">{{ $judul }}</h4>
            <div class="row d-flex flex-column">
              <div class="col">
                <div class="form-group">
                  <label class="fw-bold mb-2 d-block">Foto</label>
                  {{-- Preview Foto --}}
                  @if ($edit->foto)
                    <img src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview mb-2" width="10%">
                  @else
                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="foto-preview mb-2" width="10%">
                  @endif
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
                    <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}>- Pilih Hak Akses -</option>
                    <option value="1" {{ old('role', $edit->role) == '1' ? 'selected' : '' }}>Super Admin</option>
                    <option value="0" {{ old('role', $edit->role) == '0' ? 'selected' : '' }}>Admin</option>
                  </select>
                  @error('role')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Status</label>
                  <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}>- Pilih Status -</option>
                    <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>NonAktif</option>
                  </select>
                  @error('status')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3 mb-2">
                  <label class="fw-bold">Nama</label>
                  <input 
                    type="text" 
                    name="nama" 
                    value="{{ old('nama', $edit->nama) }}" 
                    class="form-control @error('nama') is-invalid @enderror" 
                    placeholder="Masukkan Nama">
                  @error('nama')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Email</label>
                  <input 
                    type="text" 
                    name="email" 
                    value="{{ old('email', $edit->email) }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Masukkan Email">
                  @error('email')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Password Baru</label>
                  <input 
                    type="text" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Masukkan Password Baru">
                  @error('password')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Konfirmasi Password Baru</label>
                  <input 
                    type="text" 
                    name="password_confirmation" 
                    value="{{ old('password_confirmation', $edit->password_confirmation) }}" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Konfirmasi Password Baru">
                  @error('password_confirmation')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">HP</label>
                  <input 
                    type="text" 
                    onkeypress="return hanyaAngka(event)" 
                    name="hp" 
                    value="{{ old('hp', $edit->hp) }}" 
                    class="form-control @error('hp') is-invalid @enderror" 
                    placeholder="Masukkan Nomor HP">
                  @error('hp')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold text-white">Perbaharui</button>
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
