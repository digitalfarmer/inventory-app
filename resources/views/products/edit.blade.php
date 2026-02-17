@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content')
<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data Produk</h3>
    </div>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="code" class="form-control" value="{{ $product->code }}" required>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Stok</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                </div>
                <div class="col-6">
                    <label>Harga</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
@stop