@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Data Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- WAJIB INI BUAT UPDATE --}}
            
            <div class="mb-3">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
            </div>
            <div class="mb-3">
                <label>Jurusan</label>
                <input type="text" name="jurusan" class="form-control" value="{{ $mahasiswa->jurusan }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection