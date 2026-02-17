<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $total_produk = Product::count();
        $total_kategori = Category::count();
        $stok_limit = Product::where('stock', '<', 10)->count(); // Barang yang stoknya mau habis

        return view('home', compact('total_produk', 'total_kategori', 'stok_limit'));
    }
}