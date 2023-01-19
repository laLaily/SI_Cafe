<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        return $admin;
    }

    public function getAdmin($id)
    {
        $admin = Admin::find($id);
        return view('admin.admin_admin', ['admin' => $admin]);;
    }

    public function updatePasswordAdmin(Request $request)
    {
        $admin = Admin::find($request->session()->get('token'));
        $admin->password = $request->input('password');
        $admin->save();
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect('/admin/admin/view');
    }

    public function loginAdmin(Request $request)
    {
        $admin = Admin::where('username', $request->input("username"))->first();

        if (Hash::check($request->input('password'), $admin->password)) {
            $request->session()->put('token', $admin->id);
            return redirect('/admin/dashboard');
        } else {
            return redirect('/admin/login');
        }
    }

    public function dashboardAdmin(Request $request)
    {
        $admin = Admin::find($request->session()->get('token'));
        return view('admin.dashboard_admin', ["admin" => $admin]);
    }

    public function logoutAdmin(Request $request)
    {
        $request->session()->forget('token');
        return redirect('/admin/login');
    }
}
