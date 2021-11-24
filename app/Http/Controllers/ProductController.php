<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * show list of product with category
     *
     * @param \Illuminate\Http\Request
     * @return \App\Models\Product
     */
    public function index(Request $request)
    {
        if ($request->has('fields')) {
            $fields = str_replace(' ', '', $request->fields);
            $fields = explode(',', $fields);
            return Product::with('category_product')->get($fields);
        }
        return Product::with('category_product')->get();
    }

    /**
     * Create a Product
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Product
     */
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

    /**
     * update a product by id
     *
     * @param \Illuminate\Http\Request $request
     * @param String $id
     * @return \App\Models\Product
     */
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

    /**
     * delete a product
     *
     * @param \Illuminate\Http\Request $request
     */
    public function destroy(Request $request)
    {
        Product::destroy($request->id);
        return ['status' => 'success'];
    }
}
