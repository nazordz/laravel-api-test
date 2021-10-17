<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::with('user')->get();
    }

    public function show($id)
    {
        return Transaction::with('user', 'transaction_products.product')->find($id);
    }

    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'products' => 'required'
        ]);

        $transaction = new Transaction();
        $transaction->user_id = $request->user()->id;
        $transaction->type = $request->type;
        $transaction->save();
        // $transaction->transaction_products()->createMany($request->products);
        foreach ($request->products as $key => $value) {
            $product = Product::find($value['product_id']);
            if ($request->type == "IN") {
                $product->stock = $product->stock + $value['stock'];
            } elseif ($request->type == "OUT") {
                $product->stock = $product->stock - $value['stock'];
            }
            $product->save();
            $transaction->transaction_products()->create([
                'stock' => $value['stock'],
                'product_id' => $value['product_id']
            ]);
        }
        return $transaction;
    }
}
