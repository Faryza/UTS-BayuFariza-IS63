@extends('layouts.app')

<!-- @title('Edit Pembayaran') -->

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Pembayaran</h1>
    <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning text-dark">
                <h6 class="m-0 font-weight-bold">Formulir Edit Pembayaran</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="penyewa_id" class="font-weight-bold">Pilih Penyewa <span class="text-danger">*</span></label>
                        <select class="form-control @error('penyewa_id') is-invalid @enderror" id="penyewa_id" name="penyewa_id" required>
                            @foreach($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}" {{ old('penyewa_id', $pembayaran->penyewa_id) == $penyewa->id ? 'selected' : '' }}>
                                    {{ $penyewa->nama }} (Kamar: {{ $penyewa->kamar->nomor_kamar ?? '-' }} | Rp {{ number_format($penyewa->kamar->harga_bulanan ?? 0, 0, ',', '.') }}/bulan)
                                </option>
                            @endforeach
                        </select>
                        @error('penyewa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="tanggal_bayar" class="font-weight-bold">Tanggal Pembayaran <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" 
                                       id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}" required>
                                @error('tanggal_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="jumlah" class="font-weight-bold">Jumlah Bayar (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                       id="jumlah" name="jumlah" value="{{ old('jumlah', $pembayaran->jumlah) }}" 
                                       placeholder="Contoh: 1500000" min="0" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="metode_pembayaran" class="font-weight-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                                <select class="form-control @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                                    <option value="Transfer" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="Tunai" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Tunai' ? 'selected' : '' }}>Tunai / Cash</option>
                                </select>
                                @error('metode_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="status" class="font-weight-bold">Status Pembayaran <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="Lunas" {{ old('status', $pembayaran->status) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="Belum Lunas" {{ old('status', $pembayaran->status) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="keterangan" class="font-weight-bold">Keterangan / Catatan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Pembayaran sewa Kamar 101 untuk bulan Mei 2026.">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning shadow-sm mr-2 text-dark font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Perbarui Pembayaran
                    </button>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary shadow-sm">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
