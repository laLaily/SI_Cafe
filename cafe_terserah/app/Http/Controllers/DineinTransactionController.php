<?php

namespace App\Http\Controllers;

use App\Models\DetailDineinTransaction;
use App\Models\DineinTransaction;
use App\Models\Product;
use App\Models\ReservationTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DineinTransactionController extends Controller
{
    public function createDineinTransaction(Request $request)
    {
        if ($request->session()->has('res_token')) {
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
        } else {
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
    }

    public function getDineinTransaction(Request $request)
    {
        if ($request->old('transaction_date') == null || $request->old('transaction_date') == "") {
            $dinein = DineinTransaction::selectRaw("*,CONCAT('Rp.',FORMAT(total_price,0,'id_ID'),',-') as price_view")->get();
            return view('admin.transaction_admin', ['dineinTransactions' => $dinein]);
        } else {
            $data = $request->old('transaction_date');
            $dataArr = explode(',', $data);
            $dinein = DineinTransaction::selectRaw("*,CONCAT('Rp.',FORMAT(total_price,0,'id_ID'),',-') as price_view")->whereBetween('transaction_date', $dataArr)->get();
            return view('admin.transaction_admin', ['dineinTransactions' => $dinein])->render();
        }
    }

    public function filterDineinTransactionByDate()
    {
        return redirect('/admin/dineintrx/view')->withInput();
    }

    public function recapDineinTransaction(Request $request)
    {
        $income = null;
        $date = null;
        if ($request->input('filter') == null || $request->input('filter') == 'week') {
            $rekap = DineinTransaction::selectRaw('SUM(total_price) as income, CONCAT(YEAR(transaction_date),\'-\',WEEK(transaction_date)) as year_week, COUNT(*) as total_transaction')->groupBy('year_week')->orderBy('year_week')->get();
            $income = null;
            $i = 0;
            foreach ($rekap as $r) {
                $income[$i] = $r->income;
                $i++;
            }

            $date = null;
            $i = 0;
            foreach ($rekap as $r) {
                $date[$i] = $r->year_week;
                $i++;
            }
        } else {
            if ($request->input('filter') == 'month') {
                $rekap = DineinTransaction::selectRaw('SUM(total_price) as income, CONCAT(YEAR(transaction_date),\'-\',MONTH(transaction_date)) as year_months, COUNT(*) as total_transaction')->groupBy('year_months')->orderBy('year_months')->get();
                $income = null;
                $i = 0;
                foreach ($rekap as $r) {
                    $income[$i] = $r->income;
                    $i++;
                }

                $date = null;
                $i = 0;
                foreach ($rekap as $r) {
                    $date[$i] = $r->year_months;
                    $i++;
                }
            } else if ($request->input('filter') == 'year') {
                $rekap = DineinTransaction::selectRaw('SUM(total_price) as income, YEAR(transaction_date) as year, COUNT(*) as total_transaction')->groupBy('year')->orderBy('year')->get();
                $income = null;
                $i = 0;
                foreach ($rekap as $r) {
                    $income[$i] = $r->income;
                    $i++;
                }

                $date = null;
                $i = 0;
                foreach ($rekap as $r) {
                    $date[$i] = $r->year;
                    $i++;
                }
            }
        }
        return response()->json(['income' => $income, 'date' => $date]);
    }

    public function getProductTransactionUserWithProduct($id)
    {
        $dinein = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.product_id')
            ->selectRaw("CONCAT('Rp.',FORMAT(detail_dinein_transactions.quantity_price,0,'id_ID'),',-') as price_view, detail_dinein_transactions.product_id, products.product_name, detail_dinein_transactions.quantity, detail_dinein_transactions.quantity_price")
            ->where('dinein_transactions.id', $id)
            ->get();

        return $dinein;
    }

    public function getDineinTransactionUserWithSeatNumber($id)
    {
        $dinein = DineinTransaction::join('seats', 'seats.id', '=', 'dinein_transactions.seat_id')
            ->selectRaw("CONCAT('Rp.',FORMAT(dinein_transactions.total_price,0,'id_ID'),',-') as price_view,dinein_transactions.*, seats.seat_number")
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
        $transactions = $this->getDineinTransactionUserWithSeatNumber($request->session()->get('session_token'));
        $carts = $this->getProductTransactionUserWithProduct($request->session()->get('session_token'));
        $products = null;
        if ($request->old('filter') == null || $request->old('filter') == '') {
            $products = Product::selectRaw("*, CONCAT('Rp.',FORMAT(product_price,0,'id_ID'),',-') as price_view")->get();
        } else {
            if ($request->old('filter') == 'food') {
                $products = Product::selectRaw("*, CONCAT('Rp.',FORMAT(product_price,0,'id_ID'),',-') as price_view")->where('product_category', 'food')->get();
            } else if ($request->old('filter') == 'beverage') {
                $products = Product::selectRaw("*, CONCAT('Rp.',FORMAT(product_price,0,'id_ID'),',-') as price_view")->where('product_category', 'beverage')->get();
            } else if ($request->old('filter') == 'dessert') {
                $products = Product::selectRaw("*, CONCAT('Rp.',FORMAT(product_price,0,'id_ID'),',-') as price_view")->where('product_category', 'dessert')->get();
            }
        }
        $totalProductCart = DetailDineinTransaction::where('dinein_id', $request->session()->get('session_token'))->sum('quantity');

        return view('order.dinein_order', ['products' => $products, 'transactions' => $transactions, 'carts' => $carts, 'totalProduct' => $totalProductCart])->render();
    }

    public function filterProductByCategory()
    {
        return redirect('/dinein/order/products')->withInput();
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

    public function getOneTransactionWithProduct($id)
    {
        $dinein = DineinTransaction::join('seats', 'seats.id', '=', 'dinein_transactions.seat_id')->where('id', $id);
        $dineins = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
            ->join('products', 'products.id', '=', 'detail_dinein_transactions.product_id')
            ->select('detail_dinein_transactions.product_id', 'products.product_name', 'detail_dinein_transactions.quantity', 'detail_dinein_transactions.quantity_price')
            ->where('dinein_transactions.id', $id)
            ->get();

        return view('admin.detailtrx_admin', ['dineintrx' => $dinein, 'detail' => $dineins]);
    }

    public function updateStatusTransaction(Request $request, $id)
    {
        $status = DineinTransaction::find($id);

        $status->status = $request->input('success');
        $status->updated_at = Carbon::now()->setTimezone('Asia/Phnom_Penh');
        $status->updater_id = $request->session()->get('token');
        $status->save();

        return redirect('/admin/dineintrx/view');
    }
}
