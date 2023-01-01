<?php

namespace App\Http\Controllers;

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

    public function getSeats()
    {
        $seats = Seat::all();
        return view('order.dinein_regis', ['seats' => $seats]);
    }
}
