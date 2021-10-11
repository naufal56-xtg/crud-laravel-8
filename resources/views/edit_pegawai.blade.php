@extends('layouts.master', ['title' => 'Edit Pegawai'])

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('pegawai') }}" class="btn btn-primary float-right">Back</a>
    </div>
    <div class="card-body">
        <div class="col-md-6 offset-3">
            <form action="{{ route('update.pegawai', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Nama Pegawai</label>
                    <input type="text" name="nama" id="" class="form-control" value="{{ old('nama', $data->nama) }}">
                    @error('nama')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kl" id="" class="form-control">
                        <option value="" disabled>Pilih Jenis Kelamin</option>
                        <option value="L" @if ($data->jenis_kl == 'L') selected @endif>Laki - Laki</option>
                        <option value="P" @if ($data->jenis_kl == 'P') selected @endif>Perempuan</option>
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
                    <img src="{{ asset('foto/'. $data->foto) }}" alt="" width="200px" class="mt-3">
                </div>
                <div class="form-group">
                    <label for="">No Handphone</label>
                    <input type="text" name="no_telp" id="" class="form-control"
                        value="{{ old('no_telp', $data->no_telp) }}">
                    @error('no_telp')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning w-100">Update Data</button>
            </form>
        </div>
    </div>
</div>
@endsection