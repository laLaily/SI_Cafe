<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function userCart(Request $request)
    {
        $products = new ProductController();

        $transactions = new DineinTransactionController();

        $carts = new DineinTransactionController();

        return view('order.dinein_order', ['products' => $products->getProducts(), 'transactions' => $transactions->getDineinTransactionUserWithSeatNumber($request->session()->get('session_token')), 'carts' => $carts->getProductTransactionUserWithProduct($request)]);
    }

    public function submitCart(Request $request)
    {
        $data = new DineinTransactionController();

        $exist = isset($data);

        if ($exist) {
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
