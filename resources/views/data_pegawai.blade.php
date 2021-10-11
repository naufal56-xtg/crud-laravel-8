@extends('layouts.master', ['title' => 'Data Pegawai'])

@section('content')
<div class="row my-2 ">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="{{ route('pegawai') }}" method="GET">
            @csrf
            <input type="text" name="search" class="form-control" placeholder="Search..">
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="{{ route('export.pdf') }}" class="btn btn-secondary float-right">Export PDF</a>
        <a href="{{ route('export.excel') }}" class="btn btn-success float-right mx-2">Export Excel</a>
        <a href="{{ route('add.pegawai') }}" class="btn btn-primary float-right mx-2">Tambah Data</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th>Nama Pegawai</th>
                    <th width="10%">Jenis Kelamin</th>
                    <th width="20%">Gambar</th>
                    <th>No Handphone</th>
                    <th>Tanggal Buat</th>
                    <th width="15%">Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                <tr class="text-center">
                    <td class="py-5">{{ $index + $data->firstItem() }}</td>
                    <td class="py-5">{{ $item->nama }}</td>
                    <td class="py-5">{{ $item->jenis_kl }}</td>
                    <td class="pt-3">
                        <img src="{{ asset('foto/'. $item->foto ) }}" alt="" width="200px" height="100px">
                    </td>
                    <td class="py-5">{{ $item->no_telp }}</td>
                    <td class="py-5">{{ $item->created_at->diffForHumans() }}</td>
                    <td class="py-5">
                        <a href="{{ route('edit.pegawai', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('delete.pegawai', $item->id) }}" class="btn btn-danger btn-sm delete-btn"
                            data-id="{{ $item->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.delete-btn').click(function (e) { 
            e.preventDefault();
            let id_pegawai = $(this).attr('data-id');
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = "/pegawai/delete-pegawai/"+ id_pegawai
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            });
        });
    });
</script>
<script>
    @if (Session::has('berhasil'))
    toastr.success("{{ Session::get('berhasil') }}", {timeOut: 1000})
    @endif
</script>
@endsection