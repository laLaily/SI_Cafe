<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function insertProduct(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_category = $request->input('product_category');
        $product->product_price = $request->input('product_price');
        $product->product_stock = $request->input('product_stock');
        $product->updater_id = $request->session()->get('token');
        $product->save();
    }

    public function getProducts()
    {
        $product = Product::all();
        return $product;
    }

    public function getOneProduct($id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function updateProduct(Request $request)
    {
        $product = new Product();
    }
}
