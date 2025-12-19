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
        <p class="mb-0 text-black">Daftar admin yang terdaftar pada sistem.</p>
        <a href="{{ route('backend.user.create') }}" class="btn btn-pink btn-pink:hover fw-bold btn-sm">
          + Tambah Admin
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($index as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->email }}</td>
                <td>
                  @if ($row->role == 1)
                    <span class="badge p-2 bg-success">Admin</span>
                  @else
                    <span class="badge p-2 bg-info text-white">Staff</span>
                  @endif
                </td>
                <td>
                  @if ($row->status == 1)
                    <span class="badge bg-primary">Aktif</span>
                  @else
                    <span class="badge bg-secondary">Nonaktif</span>
                  @endif
                </td>
                <td class="d-flex justify-content-center gap-2">
                  <a href="{{ route('backend.user.edit', $row->id_admin) }}" class="btn btn-sm btn-warning">
                    <i data-feather="edit-3" class="me-1 align-items-center"></i>
                    Edit
                  </a>

                  <form action="{{ route('backend.user.destroy', $row->id_admin) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
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
                <td colspan="6" class="text-muted">Belum ada data pengguna.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
