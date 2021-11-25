<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\CategoryProduct
     */
    public function index(Request $request)
    {
        if ($request->has('fields')) {
            $fields = str_replace(' ', '', $request->fields);
            $fields = explode(',', $fields);
            return CategoryProduct::take(100)->get($fields);
        } else {
            return CategoryProduct::take(100)->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        return CategoryProduct::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param String $id
     * @return \App\Models\CategoryProduct
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        $categoryProduct = CategoryProduct::find($id);
        if (!$categoryProduct) {
            return response()->json(['status' => 'Category Product not found'], 404);
        }
        $categoryProduct->name = $request->name;
        $categoryProduct->description = $request->description;
        $categoryProduct->save();
        return $categoryProduct;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        CategoryProduct::destroy($request->id);
        return ['status' => 'success'];
    }
}
