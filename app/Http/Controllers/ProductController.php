<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category_product')->get();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'                => 'required',
            'description'         => 'required',
            'image'               => 'nullable|image',
            'category_product_id' => 'required|exists:category_products,id',
            'stock'               => 'required',
        ]);
        $newProduct = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->image->storeAs('public/products', Str::random(5).'-'.$request->image->getClientOriginalName());
            $newProduct['image'] = Storage::url($path);
        }

        return Product::create($newProduct);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                => 'required',
            'description'         => 'required',
            'image'               => 'nullable|image',
            'category_product_id' => 'required|exists:category_products,id',
            'stock'               => 'required',
        ]);

        $product = Product::find($id);
        $product->name                = $request->name;
        $product->description         = $request->description;
        $product->category_product_id = $request->category_product_id;
        $product->stock               = $request->stock;
        if ($request->hasFile('image')) {
            $path = $request->image->storeAs('public/products', Str::random(5).'-'.$request->image->getClientOriginalName());
            $product->image = Storage::url($path);
        }
        $product->save();
        return $product;
    }

    public function destroy(Request $request)
    {
        Product::destroy($request->id);
        return ['status' => 'success'];
    }
}
