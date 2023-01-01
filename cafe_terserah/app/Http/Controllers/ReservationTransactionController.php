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
        $res->save();

        $data = ReservationTransaction::where('customer_name', $request->input('customer_name'))->where('reservation_date', $request->input('reservation_date'))->orderBy('id', 'desc')->first();

        if ($data != NULL) {
            $request->session()->put('res_token', $data->id);
            return redirect('/reservation/feature');
        } else {
            return redirect('/reservation/order');
        }
    }

    public function getDataReservationUser($id)
    {
        $res = ReservationTransaction::find($id);
        return $res;
    }

    public function updateReservationTransactionUser($idReservation, $idDinein)
    {
        $res = ReservationTransaction::find($idReservation);

        $res->dinein_transaction_id = $idDinein;
        $res->save();
    }
}
