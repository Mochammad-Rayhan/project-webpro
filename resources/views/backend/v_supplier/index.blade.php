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
        <p class="mb-0 text-black">Daftar Supplier Beauty Care</p>
        <a href="{{ route('backend.supplier.create') }}" class="btn btn-pink fw-bold btn-sm">
          + Tambah data
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Kode Supplier</th>
              <th>Nama Supplier</th>
              <th>No HP</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($index as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->kode_supplier }}</td>
                <td>{{ $row->nama_supplier }}</td>
                <td>{{ $row->no_hp }}</td>
                <td>{{ $row->alamat }}</td>
                <td class="d-flex justify-content-center gap-2">
                  <a href="{{ route('backend.supplier.edit', $row->kode_supplier) }}" class="btn btn-sm btn-warning">
                    <i data-feather="edit-3" class="me-1 align-items-center"></i>
                    Edit
                  </a>

                  <form action="{{ route('backend.supplier.destroy', $row->kode_supplier) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger btn-danger:hover">
                      <i data-feather="trash-2" class="me-1 align-items-center"></i>
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-muted">Belum ada data supplier.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection