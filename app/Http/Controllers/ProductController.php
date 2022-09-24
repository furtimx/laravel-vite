<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $data = Product::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'detail' => $request->detail
        ]);

        return redirect()->route('product.index')->with('status', 'Product saved!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->save();

        return redirect()->route('product.edit',$product->id)->with('status', 'Product updated!');
    }

    public function show(Product $product)
    {
        return redirect()->route('product.edit', $product)->with('status', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('status', 'Product deleted!');
    }
}
