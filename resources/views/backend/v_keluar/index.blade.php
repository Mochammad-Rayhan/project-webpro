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
        <p class="mb-0 text-black">Daftar barang keluar yang terdaftar pada sistem.</p>
        <a href="{{ route('backend.keluar.create') }}" class="btn btn-pink fw-bold btn-sm">
          + Tambah Barang
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Produk</th>
              <th>Admin</th>
              <th>Jumlah Keluar</th>
              <th>Total Pengeluaran</th>
              <th>Tanggal Keluar</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($index as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->produk->nama_produk }}</td>
                <td>{{ $row->user->nama }}</td>
                <td>{{ $row->jumlah_keluar }}</td>
                <td>{{ $row->total_keluar }}</td>
                <td>{{ $row->tanggal_keluar}}</td>
                <td>{{ $row->keterangan}}</td>
                <td class="d-flex justify-content-center gap-2">
                  <a href="{{ route('backend.keluar.edit', $row->id) }}" class="btn btn-sm btn-warning">
                    <i data-feather="edit-3" class="me-1 align-items-center"></i>
                    Ubah
                  </a>

                  <form action="{{ route('backend.keluar.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
    </div>
  </div>
</div>
@endsection