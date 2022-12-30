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
        $data = DetailDineinTransaction::where('dinein_id', $request->input('dinein_id'))->where('product_id', $request->input('product_id'))->first();

        if ($data == NULL) {
            $prod = new ProductController();
            $dataprod = $prod->getOneProduct($request->input('product_id'));

            $det = new DetailDineInTransaction();
            $det->dinein_id = $request->input('dinein_id');
            $det->product_id = $request->input('product_id');
            $det->quantity = $request->input('quantity');
            $det->quantity_price = ($request->input('quantity') * $dataprod->product_price);
            $det->save();

            $dine = new DineinTransactionController();
            $dine->updatePrice(($request->input('quantity') * $dataprod->product_price), $request->input('dinein_id'));
        } else {
            $prod = new ProductController();
            $dataprod = $prod->getOneProduct($request->input('product_id'));

            DetailDineInTransaction::where('dinein_id', $request->input('dinein_id'))->where('product_id', $request->input('product_id'))
                ->update(['quantity' => ($data->quantity + $request->input('quantity')), 'quantity_price' => ($data->quantity_price + ($request->input('quantity') * $dataprod->product_price))]);

            $dine = new DineinTransactionController();
            $dine->updatePrice(($request->input('quantity') * $dataprod->product_price), $request->input('dinein_id'));
        }
    }
}