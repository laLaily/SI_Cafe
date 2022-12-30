<?php

namespace App\Http\Controllers;

use App\Models\DineinTransaction;
use Illuminate\Http\Request;

class DineinTransactionController extends Controller
{
    public function createDineinTransaction(Request $request)
    {
        $dinein = new DineinTransaction();
        $dinein->customer_name = $request->input('customer_name');
        $dinein->seat_id = $request->input('seat_id');
        $dinein->save();

        $data = DineinTransaction::where('customer_name', $request->input('customer_name'))->where('seat_id', $request->input('seat_id'))->orderBy('id', 'desc')->first();

        if ($data != NULL) {
            $request->session()->put('session_token', $data->id);
            return redirect('/dinein/order/products');
        } else {
            return redirect('/dinein/order');
        }
    }

    public function getDineinTransactionUserWithProduct(Request $request)
    {
        $dinein = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.dinein_id')
            ->select('products.product_name', 'products.product_category', 'detail_dinein_transactions.quantity', 'detail_dinein_transactions.quantity_price')
            ->where('dinein_transactions.id', $request->cookie('session_token'))
            ->get();

        return $dinein;
    }

    public function getProductTransactionUserWithProduct(Request $request)
    {
        $dinein = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.dinein_id')
            ->select('dinein_transactions.*', 'products.*', 'detail_dinein_transactions.quantity', 'detail_dinein_transactions.quantity_price')
            ->where('dinein_transactions.id', $request->session()->has('session_token'))
            ->get();

        return $dinein;
    }

    public function getDineinTransactionUserWithoutProduct($id)
    {
        $dinein = DineinTransaction::find($id);
        return $dinein;
    }

    public function updatePrice($price, $id)
    {
        $dinein = DineinTransaction::find($id);
        $dinein->total_price += $price;
        $dinein->save();
    }
}
