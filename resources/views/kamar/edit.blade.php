@extends('layouts.app')

@title('Edit Kamar')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kamar - {{ $kamar->nomor_kamar }}</h1>
    <a href="{{ route('kamar.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-2"></i> Kembali ke Daftar
    </a>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Kamar</h6>
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

                <form action="{{ route('kamar.update', $kamar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="nomor_kamar" class="font-weight-bold">Nomor Kamar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nomor_kamar') is-invalid @enderror" 
                               id="nomor_kamar" name="nomor_kamar" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" 
                               placeholder="Contoh: Room 101, A2" required>
                        @error('nomor_kamar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipe_kamar" class="font-weight-bold">Tipe Kamar <span class="text-danger">*</span></label>
                        <select class="form-control @error('tipe_kamar') is-invalid @enderror" id="tipe_kamar" name="tipe_kamar" required>
                            <option value="Standard" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Standard' ? 'selected' : '' }}>Standard</option>
                            <option value="Deluxe" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                            <option value="Suite" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Suite' ? 'selected' : '' }}>Suite</option>
                        </select>
                        @error('tipe_kamar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga_bulanan" class="font-weight-bold">Harga Bulanan (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga_bulanan') is-invalid @enderror" 
                               id="harga_bulanan" name="harga_bulanan" value="{{ old('harga_bulanan', $kamar->harga_bulanan) }}" 
                               placeholder="Contoh: 1500000" min="0" required>
                        @error('harga_bulanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Tersedia" {{ old('status', $kamar->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia (Vacant)</option>
                            <option value="Terisi" {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>Terisi (Occupied)</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary shadow-sm mr-2">
                        <i class="fas fa-save mr-1"></i> Perbarui Kamar
                    </button>
                    <a href="{{ route('kamar.index') }}" class="btn btn-secondary shadow-sm">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
