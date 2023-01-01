<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DineResController extends Controller
{
    public function dineresControl(Request $request)
    {
        $dinein = new DineinTransactionController();

        if ($request->session()->has('res_token')) {
            return $dinein->createDineinTransactionReservation($request);
        } else {
            return $dinein->createDineinTransaction($request);
        }
    }
}
