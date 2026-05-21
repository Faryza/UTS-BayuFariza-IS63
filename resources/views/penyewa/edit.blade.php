@extends('layouts.app')

<!-- @title('Edit Penyewa') -->

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Penyewa - {{ $penyewa->nama }}</h1>
    <a href="{{ route('penyewa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">Formulir Edit Penyewa</h6>
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

                <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="nama" class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama', $penyewa->nama) }}" 
                               placeholder="Nama penyewa..." required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="no_hp" class="font-weight-bold">Nomor WhatsApp/HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                       id="no_hp" name="no_hp" value="{{ old('no_hp', $penyewa->no_hp) }}" 
                                       placeholder="Contoh: 08123456789" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $penyewa->email) }}" 
                                       placeholder="email@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="pekerjaan" class="font-weight-bold">Pekerjaan</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $penyewa->pekerjaan) }}" 
                               placeholder="Contoh: Mahasiswa, Karyawan Swasta...">
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kamar_id" class="font-weight-bold">Pilih Kamar Kost <span class="text-danger">*</span></label>
                        <select class="form-control @error('kamar_id') is-invalid @enderror" id="kamar_id" name="kamar_id" required>
                            @foreach($kamars as $kamar)
                                <option value="{{ $kamar->id }}" {{ old('kamar_id', $penyewa->kamar_id) == $kamar->id ? 'selected' : '' }}>
                                    {{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }} (Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}/bulan)
                                    @if($kamar->id == $penyewa->kamar_id)
                                        [Kamar Saat Ini]
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('kamar_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="tanggal_masuk" class="font-weight-bold">Tanggal Masuk <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                               id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $penyewa->tanggal_masuk) }}" required>
                        @error('tanggal_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success shadow-sm mr-2">
                        <i class="fas fa-save mr-1"></i> Perbarui Penyewa
                    </button>
                    <a href="{{ route('penyewa.index') }}" class="btn btn-secondary shadow-sm">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
