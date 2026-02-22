<?php
namespace App\Http\Controllers;

use App\Models\StockEntry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockEntryController extends Controller
{
    public function index() {
        // Mengambil data terbaru, lengkap dengan data produknya (eager loading)
    $entries = StockEntry::with('product')->orderBy('date', 'desc')->get();
    
    return view('stock_entries.index', compact('entries'));
    }

    public function create() {
        $products = Product::all();
        return view('stock_entries.create', compact('products'));
    }

    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        // Pakai Database Transaction supaya kalau gagal, stok gak berantakan
        DB::transaction(function () use ($request) {
            // 1. Simpan data transaksi
            StockEntry::create($request->all());

            // 2. Update stok di tabel products
            $product = Product::find($request->product_id);
            $product->increment('stock', $request->qty);
        });

        return redirect()->route('stock-in.index')->with('success', 'Stok berhasil ditambah!');
    }
    public function destroy(StockEntry $stock_in) // Laravel otomatis cari ID-nya
{
    DB::transaction(function () use ($stock_in) {
        $product = Product::find($stock_in->product_id);
        
        // Balikin stok: Karena ini barang masuk yang dihapus, maka stok dikurangi
        $product->decrement('stock', $stock_in->qty);
        
        $stock_in->delete();
    });

    return back()->with('success', 'Transaksi dibatalkan, stok telah disesuaikan.');
}
}