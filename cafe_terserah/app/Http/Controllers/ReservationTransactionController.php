<?php

namespace App\Http\Controllers;

use App\Models\ReservationTransaction;
use Illuminate\Http\Request;

class ReservationTransactionController extends Controller
{
    public function createReservationTransaction(Request $request)
    {
        $res = new ReservationTransaction();
        $res->customer_name = $request->input('customer_name');
        $res->reservation_date = $request->input('reservation_date');
        $res->total_person = $request->input('total_person');

        return redirect('/reservation/success');
    }
}
