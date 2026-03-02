<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockEntry;
use App\Models\StockExit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        
        // Barang yang stoknya kritis (misal < 10)
        $stokKritis = Product::where('stock', '<', 10)->count();
        
        // Total barang yang masuk & keluar HARI INI saja
        $masukHariIni = StockEntry::whereDate('date', today())->sum('qty');
        $keluarHariIni = StockExit::whereDate('date', today())->sum('qty');

        return view('home', compact(
            'totalProduk', 
            'stokKritis', 
            'masukHariIni', 
            'keluarHariIni'
        ));
    }
}