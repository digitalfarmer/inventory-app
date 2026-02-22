@extends('adminlte::page')

@section('title', 'Riwayat Barang Keluar')

@section('content_header')
    <h1>Riwayat Barang Keluar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Transaksi Keluar</h3>
        <div class="card-tools">
            <a href="{{ route('stock-out.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Input Stok Keluar
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exits as $key => $exit)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($exit->date)->format('d/m/Y') }}</td>
                    <td><span class="badge badge-info">{{ $exit->product->code }}</span></td>
                    <td>{{ $exit->product->name }}</td>
                    <td><b class="text-danger">- {{ $exit->qty }}</b>.</td>
                    <td>{{ $exit->description ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada riwayat barang Keluar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop