<?php

namespace App\Http\Controllers\Product;

use App\Exports\StockReportExport;
use App\Http\Controllers\Controller;
use App\Models\StockEntry;
use App\Models\StockExit;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel; // <--- INI BENAR (Ini memanggil Facade)



class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default: Ambil data bulan ini jika tanggal tidak diisi
        $start_date = $request->start_date ?? date('Y-m-01');
        $end_date = $request->end_date ?? date('Y-m-d');

        $dataMasuk = StockEntry::with('product')
            ->whereBetween('date', [$start_date, $end_date])
            ->latest()
            ->get();

        $dataKeluar = StockExit::with('product')
            ->whereBetween('date', [$start_date, $end_date])
            ->latest()
            ->get();

        return view('products.reports.index', compact('dataMasuk', 'dataKeluar', 'start_date', 'end_date'));
    }
    public function exportExcel(Request $request)
    {
        $start_date = $request->start_date ?? date('Y-m-01');
        $end_date = $request->end_date ?? date('Y-m-d');

        return Excel::download(new StockReportExport($start_date, $end_date), 'laporan-stok.xlsx');
    }
}

