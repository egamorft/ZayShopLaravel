<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function show_category()
    {
        $show_category = DB::table('tbl_category')->get();
        $manager_category = view('admin.show_category')->with('show_category', $show_category);
        return view('admin_layout')->with('admin.show_category', $manager_category);
    }
    public function add_category()
    {
        return view('admin.add_category');
    }
    public function save_category(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;

        DB::table('tbl_category')->insert($data);
        Session::put('message', 'Add category successfully');
        return Redirect::to('add-category');
    }
}
