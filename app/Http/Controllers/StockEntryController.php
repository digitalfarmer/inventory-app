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
}