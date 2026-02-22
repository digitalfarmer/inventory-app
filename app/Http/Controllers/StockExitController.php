<?php
namespace App\Http\Controllers;

use App\Models\StockExit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockExitController extends Controller
{
    public function index() {
        $exits = StockExit::with('product')->latest()->get();
        return view('stock_exits.index', compact('exits'));
    }

    public function create() {
        $products = Product::where('stock', '>', 0)->get(); // Hanya tampilkan yang ada stok
        return view('stock_exits.create', compact('products'));
    }

    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi: Cek apakah stok cukup
        if ($product->stock < $request->qty) {
            return back()->withErrors(['qty' => 'Stok tidak mencukupi! Stok saat ini: ' . $product->stock]);
        }

        DB::transaction(function () use ($request, $product) {
            // 1. Catat Barang Keluar
            StockExit::create($request->all());

            // 2. Kurangi Stok
            $product->decrement('stock', $request->qty);
        });

        return redirect()->route('stock-out.index')->with('success', 'Barang berhasil keluar!');
    }
}