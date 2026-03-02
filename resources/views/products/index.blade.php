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
        <table id="table-produk" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@stop

@section('js')
<script>
    $(function () {
        // 1. DataTable tanpa memanggil URL bahasa luar (biar gak CORS error)
        var table = $('#table-produk').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'stock', name: 'stock' },
                { data: 'price_format', name: 'price_format' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // 2. SweetAlert Hapus (Event Delegation)
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');

            // Kita pastikan panggil Swal (versi terbaru)
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data produk ini akan dihapus permanen!",
                icon: 'warning', 
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value || result.isConfirmed) { // Support v8 dan v11
                    form.submit();
                }
            });
        });
    });
</script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif
@stop