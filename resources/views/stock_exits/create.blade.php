@extends('adminlte::page')
@section('title', 'Tambah Stok')

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Input Barang Keluar</h3>
    </div>
    <form action="{{ route('stock-out.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Pilih Produk</label>
                <select name="product_id" class="form-control select2">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->code }} - {{ $p->name }} (Stok: {{ $p->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah Keluar</label>
                <input type="number" name="qty" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            {{-- Tambahkan ini di resources/views/stock_entries/create.blade.php --}}
            <div class="form-group">
                <label>Keterangan (Opsional)</label>
                <textarea name="description" class="form-control" rows="2"
                    placeholder="Contoh: Supplier A / Re-stock mingguan"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Keluarkan Stok</button>
        </div>
    </form>
</div>
@stop