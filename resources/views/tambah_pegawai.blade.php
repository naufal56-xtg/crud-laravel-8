@extends('layouts.master', ['title' => 'Tambah Pegawai'])

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('pegawai') }}" class="btn btn-primary float-right">Back</a>
    </div>
    <div class="card-body">
        <div class="col-md-6 offset-3">
            <form action="{{ route('store.pegawai') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Nama Pegawai</label>
                    <input type="text" name="nama" id="" class="form-control" value="{{ old('nama') }}">
                    @error('nama')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kl" id="" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    @error('jenis_kl')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Upload Gambar</label>
                    <input type="file" name="foto" id="" class="form-control">
                    @error('foto')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">No Handphone</label>
                    <input type="text" name="no_telp" id="" class="form-control">
                    @error('no_telp')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Save Data</button>
            </form>
        </div>
    </div>
</div>
@endsection