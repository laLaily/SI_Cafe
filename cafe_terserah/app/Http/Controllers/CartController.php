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
        $request->session()->forget('session_token');
        return redirect('/home');
    }
}
