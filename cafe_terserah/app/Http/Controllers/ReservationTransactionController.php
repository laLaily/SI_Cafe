<?php

namespace App\Http\Controllers;

use App\Models\DineinTransaction;
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

    public function submitReservation(Request $request)
    {
        $res = $request->session()->get('res_token');

        if (isset($res)) {
            $request->session()->forget('res_token');
        }

        return redirect('/');
    }

    public function getReservationTransactions()
    {
        $reservations = ReservationTransaction::all();
        return view('admin.reservationTransaction_admin', ['reservations' => $reservations]);
    }

    public function getReservationTransactionsUser($id)
    {
        $reservations = ReservationTransaction::select('reservation_transactions.id as rid', 'reservation_transactions.customer_name', 'reservation_transactions.reservation_date', 'reservation_transactions.status', 'reservation_transactions.total_person', 'dinein_transactions.id as did', 'seats.seat_number', 'dinein_transactions.total_price')->join('dinein_transactions', 'dinein_transactions.id', '=', 'reservation_transactions.dinein_id', 'left')->join('seats', 'seats.id', '=', 'dinein_transactions.seat_id', 'left')->where('reservation_transactions.id', '=', $id)->get();

        $dineinId = null;
        foreach ($reservations as $reservation) {
            if ($reservation->did != null) {
                $dineinId = $reservation->did;
            }
        }

        if ($dineinId == null) {
            return view('admin.detail_reservation', ['reservations' => $reservations]);
        } else {
            $dineins = DineinTransaction::join('detail_dinein_transactions', 'dinein_transactions.id', '=', 'detail_dinein_transactions.dinein_id')
                ->join('products', 'products.id', '=', 'detail_dinein_transactions.product_id')
                ->selectRaw("CONCAT('Rp.',FORMAT(detail_dinein_transactions.quantity_price,0,'id_ID'),',-') as price_view, detail_dinein_transactions.product_id, products.product_name, detail_dinein_transactions.quantity, detail_dinein_transactions.quantity_price")
                ->where('dinein_transactions.id', $dineinId)
                ->get();

            return view('admin.detail_reservation', ['reservations' => $reservations, 'dineins' => $dineins]);
        }
    }
}
