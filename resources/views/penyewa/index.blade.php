@extends('layouts.app')

@title('Daftar Penyewa')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Data Penyewa</h1>
    <a href="{{ route('penyewa.create') }}" class="d-none d-sm-inline-block btn btn-success shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-2"></i> Tambah Penyewa
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-success text-white">
        <h6 class="m-0 font-weight-bold">Daftar Penyewa Aktif</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Pekerjaan</th>
                        <th>Nomor Kamar</th>
                        <th>Tanggal Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyewas as $index => $penyewa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $penyewa->nama }}</strong><br><small class="text-muted">{{ $penyewa->email ?? '-' }}</small></td>
                            <td>{{ $penyewa->no_hp }}</td>
                            <td>{{ $penyewa->pekerjaan ?? '-' }}</td>
                            <td>
                                @if($penyewa->kamar)
                                    <span class="badge badge-primary font-weight-bold py-2 px-3">{{ $penyewa->kamar->nomor_kamar }}</span>
                                @else
                                    <span class="badge badge-secondary">Belum ada Kamar</span>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($penyewa->tanggal_masuk)) }}</td>
                            <td>
                                <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="btn btn-sm btn-info shadow-sm mr-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('penyewa.destroy', $penyewa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penyewa ini? Kamar yang ditempati akan diatur menjadi Tersedia kembali.')">
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
                            <td colspan="7" class="text-center">Data penyewa kosong. Silakan tambah penyewa baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
