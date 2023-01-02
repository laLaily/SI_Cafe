<?php

namespace App\Http\Controllers;

use App\Models\ReservationTransaction;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function createSeat(Request $request)
    {
        $seat = new Seat();
        $seat->seat_number = $request->input('seat_number');
        $seat->seat_type = $request->input('seat_type');
        $seat->admin_id = $request->session()->get('token');
        $seat->save();
    }

    public function getSeats(Request $request)
    {
        $seats = Seat::all();

        $res = $request->session()->get('res_token');
        if ($res) {
            $reservtion = ReservationTransaction::find($res);
            return view('order.dinein_regis', ['seats' => $seats, 'reservations' => $reservtion]);
        } else {
            return view('order.dinein_regis', ['seats' => $seats]);
        }
    }
}
