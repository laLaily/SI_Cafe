<?php

namespace App\Http\Controllers;

use App\Models\DineinTransaction;
use App\Models\Product;
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

    public function createDineinTransactionReservation(Request $request)
    {
        $res = new ReservationTransactionController();
        $dat = $res->getDataReservationUser($request->session()->get('res_token'));

        $dinein = new DineinTransaction();
        $dinein->customer_name = $dat->customer_name;
        $dinein->seat_id = $request->input('seat_id');
        $dinein->transaction_date = $dat->reservation_date;
        $dinein->save();

        $data = DineinTransaction::where('customer_name', $dat->customer_name)->where('seat_id', $request->input('seat_id'))->orderBy('id', 'desc')->first();

        $update = new ReservationTransactionController();
        $update->updateReservationTransactionUser($request->session()->get('res_token'), $data->id);

        if ($data != NULL) {
            $request->session()->put('session_token', $data->id);
            return redirect('/dinein/order/products');
        } else {
            return redirect('/dinein/order');
        }
    }

    public function getProductTransactionUserWithProduct(Request $request)
    {
        $dinein = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.product_id')
            ->select('detail_dinein_transactions.product_id', 'products.product_name', 'detail_dinein_transactions.quantity', 'detail_dinein_transactions.quantity_price')
            ->where('dinein_transactions.id', $request->session()->get('session_token'))
            ->get();

        return $dinein;
    }

    public function getDineinTransactionUserWithSeatNumber($id)
    {
        $dinein = DineinTransaction::join('seats', 'seats.id', '=', 'dinein_transactions.seat_id')
            ->select('dinein_transactions.*', 'seats.seat_number')
            ->where('dinein_transactions.id', $id)
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

    public function substractPrice($price, $id)
    {
        $dinein = DineinTransaction::find($id);
        $dinein->total_price -= $price;
        $dinein->save();
    }
}
