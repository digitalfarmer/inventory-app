@extends('adminlte::page')

@section('title', 'Kategori')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Tambah Kategori</h3></div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <input type="text" name="name" class="form-control" placeholder="Nama Kategori" required>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Nama Kategori</th><th width="100px">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $c)
                        <tr>
                            <td>{{ $c->name }}</td>
                            <td>
                                <form action="{{ route('categories.destroy', $c->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop