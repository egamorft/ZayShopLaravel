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
        if ($data['category_name'] == null || $data['category_status'] == null) {
            Session::put('error', 'Add category fail');
            return Redirect::to('add-category');
        } else {
            DB::table('tbl_category')->insert($data);
            Session::put('message', 'Add category successfully');
            return Redirect::to('add-category');
        }
    }
    public function unactive_category($category_id)
    {
        DB::table('tbl_category')->where('category_id', $category_id)->update(['category_status' => 0]);
        Session::put('message', 'Unactive category ' . $category_id);
        return Redirect::to('show-category');
    }
    public function active_category($category_id)
    {
        DB::table('tbl_category')->where('category_id', $category_id)->update(['category_status' => 1]);
        Session::put('message', 'Active category ' . $category_id);
        return Redirect::to('show-category');
    }
    public function edit_category($category_id)
    {
        $edit_category = DB::table('tbl_category')->where('category_id', $category_id)->get();
        $manager_category = view('admin.edit_category')->with('edit_category', $edit_category);
        return view('admin_layout')->with('admin.edit_category', $manager_category);
    }
    public function delete_category($category_id)
    {
        DB::table('tbl_category')->where('category_id', $category_id)->delete();
        Session::put('message', 'Delete category ' . $category_id);
        return Redirect::to('show-category');
    }
    public function update_category(Request $request, $category_id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        DB::table('tbl_category')->where('category_id', $category_id)->update($data);
        Session::put('message', 'Update category ' . $category_id);
        return Redirect::to('show-category');
    }
}
