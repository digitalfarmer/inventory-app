<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($row) {
                    return $row->category->name ?? '-';
                })
                ->addColumn('price_format', function ($row) {
                    return 'Rp ' . number_format($row->price, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="btn-group">
                        <a href="' . route('products.edit', $row->id) . '" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . route('products.destroy', $row->id) . '" method="POST" class="d-inline"> 
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('products.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';

                    // Cek apakah user punya role admin baru munculin tombol hapus
                    if (auth()->user()->hasRole('admin')) {
                        $btn .= '
        <form action="' . route('products.destroy', $row->id) . '" method="POST" class="d-inline"> 
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            <button type="button" class="btn btn-danger btn-sm btn-delete">
                <i class="fas fa-trash"></i>
            </button>
        </form>';
                    }

                    return '<div class="btn-group">' . $btn . '</div>';
                })
                ->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
