<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    public function show_sub_category()
    {
        $show_sub_category = DB::table('tbl_subcategory')->join('tbl_category', 'tbl_subcategory.category_id', '=', 'tbl_category.category_id')->get();
        $manager_sub_category = view('admin.show_sub_category')->with('show_sub_category', $show_sub_category);
        return view('admin_layout')->with('admin.show_sub_category', $manager_sub_category);
    }
    public function add_sub_category()
    {
        $get_category = DB::table('tbl_category')->where('category_status', '1')->get();
        $manager_category = view('admin.add_sub_category')->with('get_category', $get_category);
        return view('admin_layout')->with('admin.add_sub_category', $manager_category);
    }
    public function save_sub_category(Request $request)
    {
        $data = array();
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcategory_desc'] = $request->subcategory_desc;
        $data['category_id'] = $request->category_id;
        $data['subcategory_status'] = $request->subcategory_status;
        $get_category = DB::table('tbl_category')->where('category_status', '1')->get();
        $manager_category = view('admin.add_sub_category')->with('get_category', $get_category);
        foreach ($manager_category->get_category as $m) {
            // var_dump($m->category_id);
            // echo '</br>';
            // var_dump((string)$data['category_id']);
            if ($m->category_id == (string)$data['category_id']) {
                if ($data['subcategory_name'] == null || $data['subcategory_status'] == null) {
                    Session::forget('error');
                    Session::put('error', 'Add subcategory fail');
                    // return Redirect::to('add-sub-category');
                    break;
                } else {
                    DB::table('tbl_subcategory')->insert($data);
                    Session::forget('error');
                    Session::put('message', 'Add subcategory');
                    // return Redirect::to('add-sub-category');
                    break;
                }
            } else {
                Session::put('error', 'Please choose one category in the box');
            }
        }
        return Redirect::to('add-sub-category');
    }
    public function unactive_sub_category($subcategory_id)
    {
        DB::table('tbl_subcategory')->where('subcategory_id', $subcategory_id)->update(['subcategory_status' => 0]);
        Session::put('message', 'Unactive subcategory ' . $subcategory_id);
        return Redirect::to('show-sub-category');
    }
    public function active_sub_category($subcategory_id)
    {
        DB::table('tbl_subcategory')->where('subcategory_id', $subcategory_id)->update(['subcategory_status' => 1]);
        Session::put('message', 'Active subcategory ' . $subcategory_id);
        return Redirect::to('show-sub-category');
    }
    public function edit_category($category_id)
    {
        $edit_category = DB::table('tbl_category')->where('category_id', $category_id)->get();
        $manager_category = view('admin.edit_category')->with('edit_category', $edit_category);
        return view('admin_layout')->with('admin.edit_category', $manager_category);
    }
    public function delete_sub_category($subcategory_id)
    {
        DB::table('tbl_subcategory')->where('subcategory_id', $subcategory_id)->delete();
        Session::put('message', 'Delete subcategory ' . $subcategory_id);
        return Redirect::to('show-sub-category');
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