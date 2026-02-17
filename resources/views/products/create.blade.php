@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
    <h1>Tambah Produk Baru</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="code" class="form-control" placeholder="Contoh: BRG001" required>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Stok Awal</label>
                    <input type="number" name="stock" class="form-control" value="0">
                </div>
                <div class="col-6">
                    <label>Harga</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('products.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
@stop