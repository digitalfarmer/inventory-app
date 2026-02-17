@extends('adminlte::page')

@section('title', 'Daftar Produk')

@section('content_header')
<h1>Master Produk</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Barang</h3>
        <div class="card-tools">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Tambah Barang</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->code }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td>
                            <span class="badge {{ $p->stock < 10 ? 'badge-danger' : 'badge-success' }}">
                                {{ $p->stock }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('products.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop