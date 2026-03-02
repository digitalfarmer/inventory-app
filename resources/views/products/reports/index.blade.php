@extends('adminlte::page')

@section('title', 'Laporan Mutasi Barang')

@section('content_header')
<h1>Laporan Mutasi Barang</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('reports.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $start_date }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $end_date }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter Data</button>
                        <button type="button" onclick="window.print()" class="btn btn-default"><i
                                class="fas fa-print"></i> Cetak</button>
                                <a href="{{ route('reports.export', ['start_date' => $start_date, 'end_date' => $end_date]) }}"
                            class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="reportTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="masuk-tab" data-toggle="pill" href="#masuk" role="tab">Barang
                        Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="keluar-tab" data-toggle="pill" href="#keluar" role="tab">Barang Keluar</a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                    <table class="table table-bordered table-striped datatable-report">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataMasuk as $in)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($in->date)) }}</td>
                                    <td>{{ $in->product->name }}</td>
                                    <td><span class="text-success">+ {{ $in->qty }}</span></td>
                                    <td>{{ $in->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="keluar" role="tabpanel">
                    <table class="table table-bordered table-striped datatable-report">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataKeluar as $out)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($out->date)) }}</td>
                                    <td>{{ $out->product->name }}</td>
                                    <td><span class="text-danger">- {{ $out->qty }}</span></td>
                                    <td>{{ $out->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    @media print {

        .btn,
        form,
        .main-footer,
        .nav-tabs {
            display: none !important;
        }

        .content-wrapper {
            margin-left: 0 !important;
        }
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.datatable-report').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "responsive": true,
        });
    });
</script>
@stop