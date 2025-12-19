@extends('backend.v_layouts.app')
@section('content')

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

<div class="container mt-4">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h3 class="fw-bold mb-2 text-pink">{{ $judul }}</h3>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0 text-black">Daftar barang masuk yang terdaftar pada sistem.</p>
        <a href="{{ route('backend.masuk.create') }}" class="btn btn-pink fw-bold btn-sm">
          + Tambah barang 
        </a>
      </div>
       <div class="mb-3">
        <form action="{{ route('backend.produk.index') }}" method="GET" class="d-flex gap-2">
            <input  type="text"
                  name="search"
                  class="form-control form-control-sm"
                  placeholder="Cari barang masuk..."
                  value="{{ request('search') }}">
  
            <!-- <button type="submit" class="btn btn-pink btn-sm fw-bold">
              Cari
            </button> -->
          </form>
      </div>
      <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Produk</th>
              <th>Admin</th>
              <th>Supplier</th>
              <th>Jumlah Masuk</th>
              <th>Total Pembelian</th>
              <th>Tanggal Masuk</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($index as $row)
              <tr>
                <td>{{ $index->firstItem() + $loop->index }}</td>
                <td>{{ $row->produk->nama_produk }}</td>
                <td>{{ $row->user->nama }}</td>
                <td>{{ $row->supplier->nama_supplier }}</td>
                <td>{{ $row->jumlah_masuk }}</td>
                <td>{{ $row->total_masuk }}</td>
                <td>{{ $row->tanggal_masuk}}</td>
                <td class="d-flex justify-content-center gap-2">
                  <a href="{{ route('backend.masuk.edit', $row->id) }}" class="btn btn-sm btn-warning">
                    <i data-feather="edit-3" class="me-1 align-items-center"></i>
                    Ubah
                  </a>

                  <form action="{{ route('backend.masuk.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i data-feather="trash-2" class="me-1 align-items-center"></i>
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-muted">Belum ada data kategori.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-3">
        {{ $index->appends(request()->query())->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection