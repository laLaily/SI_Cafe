<?php

namespace App\Http\Controllers;

use App\Models\DetailDineInTransaction;
use App\Models\DineinTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailDineinTransactionController extends Controller
{
    public function createDetailDineinTrasaction(Request $request)
    {
        $data = DetailDineinTransaction::where('dinein_id', $request->session()->get('session_token'))->where('product_id', $request->input('product_id'))->first();

        if ($data == NULL) {

            $dataprod = Product::find($request->input('product_id'));

            $det = new DetailDineInTransaction();
            $det->dinein_id = $request->session()->get('session_token');
            $det->product_id = $request->input('product_id');
            $det->quantity = $request->input('quantity');
            $det->quantity_price = ($request->input('quantity') * $dataprod->product_price);
            $det->save();

            $dine = DineinTransaction::find($request->session()->get('session_token'));
            $dine->total_price += ($request->input('quantity') * $dataprod->product_price);
            $dine->save();
        } else {
            $dataprod = Product::find($request->input('product_id'));

            DetailDineInTransaction::where('dinein_id', $request->session()->get('session_token'))->where('product_id', $request->input('product_id'))
                ->update(['quantity' => ($data->quantity + $request->input('quantity')), 'quantity_price' => ($data->quantity_price + ($request->input('quantity') * $dataprod->product_price))]);

            $dine = DineinTransaction::find($request->session()->get('session_token'));
            $dine->total_price += ($request->input('quantity') * $dataprod->product_price);
            $dine->save();
        }

        return redirect('/dinein/order/products');
    }

    public function deleteProductCart(Request $request)
    {
        $data = DetailDineinTransaction::where('dinein_id', $request->session()->get('session_token'))->where('product_id', $request->input('product_id'))->first();

        $dine = DineinTransaction::find($request->session()->get('session_token'));
        $dine->total_price -= $data->quantity_price;
        $dine->save();

        DetailDineinTransaction::where('dinein_id', $request->session()->get('session_token'))->where('product_id', $request->input('product_id'))->delete();

        return redirect('/dinein/order/products');
    }

    public function getDetailDineinUser(Request $request)
    {
        $data = DetailDineInTransaction::where('dinein_transactions_id', $request->session()->get('session_token'))->get();
        return $data->toArray();
    }

    
}
