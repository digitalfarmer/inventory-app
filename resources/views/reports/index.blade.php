@extends('adminlte::page')
@section('title', 'Laporan Mutasi')

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('reports.index') }}" method="GET" class="form-inline">
            <input type="date" name="start_date" value="{{ $start_date }}" class="form-control mr-2">
            <input type="date" name="end_date" value="{{ $end_date }}" class="form-control mr-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
    <div class="card-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#tab_in" data-toggle="tab">Barang Masuk</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_out" data-toggle="tab">Barang Keluar</a></li>
            </ul>
            <div class="tab-content mt-3">
                <div class="tab-pane active" id="tab_in">
                    </div>
                <div class="tab-pane" id="tab_out">
                    </div>
            </div>
        </div>
    </div>
</div>
@stop