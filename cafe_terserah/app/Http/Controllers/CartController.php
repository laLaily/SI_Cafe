<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function userCart(Request $request)
    {
        $products = new ProductController();

        $carts = new DineinTransactionController();

        return view('order.dinein_order', ['products' => $products->getProducts(), 'carts' => $carts->getProductTransactionUserWithProduct($request)]);
    }
}
