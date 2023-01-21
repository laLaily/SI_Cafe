<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DineinTransaction;
use App\Models\Product;
use App\Models\ReservationTransaction;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function insertAdmin(Request $request)
    {
        $admin = new Admin();
        $admin->username = $request->input("username");
        $admin->password = $request->input("password");
        $admin->save();
    }

    public function getAdmins()
    {
        $admin = Admin::all();
        return view('admin.admin_admin', ['admins' => $admin]);
    }

    public function getAdmin(Request $request)
    {
        $admin = Admin::find($request->session()->get('token'));
        return view('admin.admin_admin', ['admin' => $admin]);
    }

    public function updatePasswordAdmin(Request $request)
    {
        $admin = Admin::find($request->session()->get('token'));
        $admin->password = $request->input('password');
        $admin->save();
        return redirect('/admin/view');
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
    }

    public function loginAdmin(Request $request)
    {
        $admin = Admin::where('username', $request->input("username"))->first();

        if (Hash::check($request->input('password'), $admin->password)) {
            $request->session()->put('token', $admin->id);
            return redirect('/admin/dashboard');
        } else {
            return view('/admin/login');
        }
    }

    public function checkPassword(Request $request)
    {
        $admin = Admin::where('username', $request->input("username"))->first();

        if (Hash::check($request->input('password'), $admin->password)) {
            return view('admin.updatepassword_admin', ["admin" => $admin]);
        } else {
            return redirect('/admin/admin_admin');
        }
    }

    public function dashboardAdmin(Request $request)
    {
        $admin = Admin::find($request->session()->get('token'));
        $totalDinein = DineinTransaction::count();
        $totalReservation = ReservationTransaction::count();
        $totalProduct = Product::count();
        $totalSeat = Seat::count();
        $tanggalRekap = Carbon::now()->setTimezone('Asia/Phnom_Penh')->format('d-m-Y');
        return view('admin.dashboard_admin', ["admin" => $admin, 'totalDinein' => $totalDinein, 'totalReservation' => $totalReservation, 'totalProduct' => $totalProduct, 'totalSeat' => $totalSeat, 'tanggalRekap' => $tanggalRekap]);
    }

    public function logoutAdmin(Request $request)
    {
        $request->session()->forget('token');
        return redirect('/admin/login');
    }
}
