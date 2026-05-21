@extends('layouts.app')

@title('Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Total Kamar Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Kamar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKamar }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-door-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kamar Tersedia Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kamar Tersedia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kamarTersedia }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penyewa Aktif Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Penyewa Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPenyewa }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Pendapatan (Lunas)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Recent Payments -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary font-weight-bold">Pembayaran Terbaru</h6>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-primary shadow-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Penyewa</th>
                                <th>Kamar</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPayments as $payment)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($payment->tanggal_bayar)) }}</td>
                                    <td>{{ $payment->penyewa->nama }}</td>
                                    <td>{{ $payment->penyewa->kamar->nomor_kamar ?? '-' }}</td>
                                    <td>Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $payment->metode_pembayaran }}</td>
                                    <td>
                                        @if($payment->status == 'Lunas')
                                            <span class="badge badge-success">Lunas</span>
                                        @else
                                            <span class="badge badge-warning">Belum Lunas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada transaksi pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Link Actions & Room Status -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="{{ route('kamar.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-plus mr-2 text-primary"></i> Tambah Kamar Baru
                    </a>
                    <a href="{{ route('penyewa.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user-plus mr-2 text-success"></i> Tambah Penyewa Baru
                    </a>
                    <a href="{{ route('pembayaran.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-receipt mr-2 text-warning"></i> Catat Pembayaran Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Hunian Kamar</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Tingkat Okupansi <span class="float-right">{{ $totalKamar > 0 ? round(($kamarTerisi / $totalKamar) * 100) : 0 }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" 
                         style="width: {{ $totalKamar > 0 ? ($kamarTerisi / $totalKamar) * 100 : 0 }}%" 
                         aria-valuenow="{{ $totalKamar > 0 ? ($kamarTerisi / $totalKamar) * 100 : 0 }}" 
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row text-center mt-3">
                    <div class="col-6 border-right">
                        <div class="h5 font-weight-bold text-success mb-0">{{ $kamarTersedia }}</div>
                        <div class="text-xs text-gray-500">Tersedia</div>
                    </div>
                    <div class="col-6">
                        <div class="h5 font-weight-bold text-danger mb-0">{{ $kamarTerisi }}</div>
                        <div class="text-xs text-gray-500">Terisi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
