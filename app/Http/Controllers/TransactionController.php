<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductTransaction;
use App\Models\Product;

class TransactionController extends Controller
{
    public function getTransactions() {
        $transactions = ProductTransaction::with('product', 'transactionStatus', 'customer')->get();

        return response()->json([
            'transactions' => $transactions
        ]);
    }

    public function addTransaction(Request $request) {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'transaction_status_id' => ['required', 'exists:transaction_statuses,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $product = Product::find($request->product_id);

        if ($product->quantity < $request->quantity) {
            return response()->json([
                'message' => 'Insufficient product stock.'
            ], 400);
        }

        // Subtract the quantity from the product stock
        $product->quantity -= $request->quantity;
        $product->save();

        $transaction = ProductTransaction::create([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'transaction_status_id' => $request->transaction_status_id,
            'quantity' => $request->quantity,
            'date_created' => now()->toDateString(), // corrected from $request->now()
        ]);

        return response()->json([
            'message' => 'Transaction added successfully',
            'transaction' => $transaction
        ]);
    }

    public function deleteTransaction($id) {
        $transaction = ProductTransaction::find($id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        // Add back the quantity to the product stock
        $product = Product::find($transaction->product_id);
        if ($product) {
            $product->quantity += $transaction->quantity;
            $product->save();
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction deleted successfully'
        ]);
    }
}
