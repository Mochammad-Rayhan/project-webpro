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
        <form class="form-horizontal" action="{{ route('backend.produk.update' , $edit->id_produk) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="card-body p-4">
            <h4 class="card-title text-pink mb-4 fw-bold">{{ $judul }}</h4>
            <div class="row d-flex flex-column">
              <div class="col">
                <div class="form-group mt-1">
                  <label class="fw-bold mb-2">Kode Produk</label>
                  <select name="kode" class="form-control @error('kode') is-invalid @enderror">
                    <option value="" {{ old('role') == '' ? 'selected' : '' }}>- Kategori Produk -</option>
                    @foreach ($kategori as $k)
                    <option value="{{ $k->kode }}" {{ old('kode', $edit->kode) == $k->kode ? 'selected' : '' }}>{{ $k->kode }}</option>
                    @endforeach
                  </select>
                  @error('kode')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mt-3 mb-2">
                  <label class="fw-bold">Nama Produk</label>
                  <input 
                    type="text" 
                    name="nama_produk" 
                    value="{{ old('nama_produk' , $edit->nama_produk) }}" 
                    class="form-control @error('nama_produk') is-invalid @enderror" 
                    placeholder="Masukkan Nama Produk">
                  @error('nama_produk')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="form-group mt-3 mb-2">
                  <label class="fw-bold">Harga Satuan</label>
                  <input 
                    type="number" 
                    name="harga_satuan" 
                    value="{{ old('harga_satuan' , $edit->harga_satuan) }}" 
                    class="form-control @error('harga_satuan') is-invalid @enderror" 
                    placeholder="Masukkan harga satuan">
                  @error('harga_satuan')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Stok Produk</label>
                  <input 
                    type="number" 
                    name="stok" 
                    value="{{ old('stok' , $edit->stok) }}" 
                    class="form-control @error('stok') is-invalid @enderror" 
                    placeholder="Masukkan Stok Produk">
                  @error('stok')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Tanggal Masuk</label>
                  <input 
                    type="date" 
                    onkeypress="return hanyaAngka(event)" 
                    name="tanggal_masuk" 
                    value="{{ old('tanggal_masuk' , $edit->tanggal_masuk) }}" 
                    class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                    placeholder="Tanggal Masuk Produk">
                  @error('tanggal_masuk')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="fw-bold mb-2">Kadaluarsa</label>
                  <input 
                    type="date" 
                    name="kadaluarsa" 
                    value="{{ old('kadaluarsa' , $edit->kadaluarsa) }}" 
                    class="form-control @error('kadaluarsa') is-invalid @enderror" 
                    placeholder="Masukkan Password">
                  @error('kadaluarsa')
                    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-pink fw-bold text-white">Perbaharui</button>
              <a href="{{ route('backend.produk.index') }}">
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
