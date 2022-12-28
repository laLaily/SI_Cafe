<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

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
        $data = Admin::all();
        return $data->toJson();
    }

    public function getAdmin($id)
    {
        $admin = Admin::find($id);
        return $admin->toJson();
    }

    public function updatePasswordAdmin(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->password = $request['password'];
        $admin->save();
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
    }

    public function loginAdmin(Request $request): int
    {
        $data = Admin::where('username', $request['username'])->where('password', $request['password'])->first();
        return $data->id;
    }
}
