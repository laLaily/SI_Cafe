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
        return redirect('/admin/product/view');
    }

    public function getProducts()
    {
        $product = Product::all();
        return view('admin.products_admin', ['products'=>$product]);
    }

    public function getOneProduct($id)
    {
        $product = Product::find($id);
        return view('admin.products_admin', ['products'=>$product]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/admin/product/view');
    }

    public function update(Request $request, $id){
        $product = Product::find($id);

        $product->product_price = $request->input('price');
        $product->product_stock = $request->input('stock');
        
        $product->updater_id=$request->session()->get('token');
        $product->save();

        return redirect('/admin/product/view');
    }

    
}
