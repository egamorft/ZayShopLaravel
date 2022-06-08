<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home(){
        return view('admin.admin_login');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
}
