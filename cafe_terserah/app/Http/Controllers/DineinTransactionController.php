<?php

namespace App\Http\Controllers;

use App\Models\DineinTransaction;
use App\Models\Product;
use App\Models\ReservationTransaction;
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
        $dat = ReservationTransaction::find($request->session()->get('res_token'));

        $dinein = new DineinTransaction();
        $dinein->customer_name = $dat->customer_name;
        $dinein->seat_id = $request->input('seat_id');
        $dinein->transaction_date = $dat->reservation_date;
        $dinein->save();

        $data = DineinTransaction::where('customer_name', $dat->customer_name)->where('seat_id', $request->input('seat_id'))->orderBy('id', 'desc')->first();

        $update = ReservationTransaction::find($request->session()->get('res_token'));
        $update->dinein_id = $data->id;
        $update->save();

        if ($data != NULL) {
            $request->session()->put('session_token', $data->id);
            return redirect('/dinein/order/products');
        } else {
            return redirect('/dinein/order');
        }
    }

    public function getProductTransactionUserWithProduct($id)
    {
        $dinein = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.product_id')
            ->select('detail_dinein_transactions.product_id', 'products.product_name', 'detail_dinein_transactions.quantity', 'detail_dinein_transactions.quantity_price')
            ->where('dinein_transactions.id', $id)
            ->get();

        return $dinein;
    }

    public function getProductTransactionUserWithProductTest(Request $request)
    {
        $dinein = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.product_id')
            ->select('detail_dinein_transactions.product_id', 'products.product_name', 'detail_dinein_transactions.quantity', 'detail_dinein_transactions.quantity_price')
            ->where('dinein_transactions.id', $request->input('dinein_transaction_id'))
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

    public function userCart(Request $request)
    {
        $products = Product::all();

        $transactions = $this->getDineinTransactionUserWithSeatNumber($request->session()->get('session_token'));

        $carts = $this->getProductTransactionUserWithProduct($request->session()->get('session_token'));

        $filterMakanan = Product::where('product_category', 'makanan')->get();
        $filterMinuman = Product::where('product_category', 'minuman')->get();
        $filterDesert = Product::where('product_category', 'desert')->get();

        return view('order.dinein_order', ['products' => $products, 'transactions' => $transactions, 'carts' => $carts, 'filterMakanan' => $filterMakanan, 'filterMinuman' => $filterMinuman, 'filterDesert' => $filterDesert]);
    }

    public function submitCart(Request $request)
    {
        $data = $this->getProductTransactionUserWithProduct($request->session()->get('session_token'));

        if (sizeof($data) != 0) {
            if ($request->session()->has('res_token')) {
                $request->session()->forget('res_token');
            }
            $request->session()->forget('session_token');
            return redirect('/dinein/order/success');
        } else {
            return redirect('/dinein/order/products');
        }
    }
}
