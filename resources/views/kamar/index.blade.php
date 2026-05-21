@extends('layouts.app')

<!-- @title('Daftar Kamar') -->

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Data Kamar</h1>
    <a href="{{ route('kamar.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-2"></i> Tambah Kamar
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kamar Kost</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Harga Bulanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kamars as $index => $kamar)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $kamar->nomor_kamar }}</strong></td>
                            <td>{{ $kamar->tipe_kamar }}</td>
                            <td>Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                            <td>
                                @if($kamar->status == 'Tersedia')
                                    <span class="badge badge-success">Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Terisi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-sm btn-info shadow-sm mr-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data kamar kosong. Silakan tambah kamar baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
