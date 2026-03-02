@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Inventory</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalProduk }}</h3>
                    <p>Total Jenis Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stokKritis }}</h3>
                    <p>Stok Menipis (< 10)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">Cek Barang <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $masukHariIni }}</h3>
                    <p>Barang Masuk (Hari Ini)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-download"></i>
                </div>
                <a href="{{ route('stock-in.index') }}" class="small-box-footer">Lihat Riwayat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $keluarHariIni }}</h3>
                    <p>Barang Keluar (Hari Ini)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-upload"></i>
                </div>
                <a href="{{ route('stock-out.index') }}" class="small-box-footer">Lihat Riwayat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Info tambahan di bawah box --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang, {{ Auth::user()->name }}!</h3>
                </div>
                <div class="card-body">
                    Aplikasi Inventory ini siap membantu kamu mengelola stok barang dengan lebih rapi. 
                    Gunakan menu di samping untuk mulai bertransaksi.
                </div>
            </div>
        </div>
    </div>
@stop