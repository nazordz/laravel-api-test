<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Models\Transaction
     */
    public function index()
    {
        return Transaction::with('user')->get();
    }

    /**
     * Display a transaction
     *
     * @param String $id
     * @return \App\Models\Transaction
     */
    public function show($id)
    {
        $transaction = Transaction::with('user', 'transaction_products.product')->find($id);
        if (!$transaction) {
            return  response()->json(['message' => 'Transaction not found'], 404);
        }
        return $transaction;
    }

    /**
     * create a transaction
     *
     * @param \Illuminate\Http\Request
     * @return \App\Models\Transaction
     */
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
                $product->save();
                $transaction->transaction_products()->create([
                    'stock' => $value['stock'],
                    'product_id' => $value['product_id']
                ]);
            } elseif ($request->type == "OUT") {
                if ($value['stock'] <= $product->stock) {
                    $product->stock = $product->stock - $value['stock'];
                    $product->save();
                    $transaction->transaction_products()->create([
                        'stock' => $value['stock'],
                        'product_id' => $value['product_id']
                    ]);
                }
            }
        }
        return $transaction;
    }
}
