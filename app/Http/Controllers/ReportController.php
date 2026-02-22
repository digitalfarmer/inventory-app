<?php

namespace App\Http\Controllers;

use App\Models\StockEntry;
use App\Models\StockExit;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Request $request)
{
    $start_date = $request->start_date ?? date('Y-m-01'); // Awal bulan
    $end_date = $request->end_date ?? date('Y-m-d');

    $in = StockEntry::with('product')
          ->whereBetween('date', [$start_date, $end_date])->get();
          
    $out = StockExit::with('product')
           ->whereBetween('date', [$start_date, $end_date])->get();

    return view('reports.index', compact('in', 'out', 'start_date', 'end_date'));
}
}
