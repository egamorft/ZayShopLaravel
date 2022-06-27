<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.login.admin_login');
    }

    public function dashboard()
    {
        // $this->AuthLogin();
        return view('admin.dashboard.dashboard');
    }

    public function login(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $request->validate([
            'admin_email' => 'required|min:8|email',
            'admin_password' => 'required|min:6'
        ]);
        $result = DB::table('tbl_admin')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)->first();

        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Email or password incorrect, try again!!');
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('/admin');
    }
}
