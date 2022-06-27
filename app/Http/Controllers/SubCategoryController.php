<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    //Admin Page
    public function show_sub_category()
    {
        $show_sub_category = DB::table('tbl_subcategory')
            ->join(
                'tbl_category',
                'tbl_subcategory.category_id',
                '=',
                'tbl_category.category_id'
            )
            ->orderBy('subcategory_id', 'desc')
            ->paginate(4);

        $manager_sub_category = view('admin.subcategory.show_sub_category')
            ->with('show_sub_category', $show_sub_category);
        return view('components.admin_layout.admin_layout')
            ->with('admin.show_sub_category', $manager_sub_category);
    }
    public function add_sub_category()
    {
        $get_category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->get();

        $manager_category = view('admin.subcategory.add_sub_category')
            ->with('get_category', $get_category);

        return view('components.admin_layout.admin_layout')
            ->with('admin.add_sub_category', $manager_category);
    }
    public function save_sub_category(Request $request)
    {
        $data = array();
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcategory_desc'] = $request->subcategory_desc;
        $data['category_id'] = $request->category_id;
        $data['subcategory_status'] = $request->subcategory_status;

        $get_category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->get();
        $manager_category = view('admin.subcategory.add_sub_category')
            ->with('get_category', $get_category);

        foreach ($manager_category->get_category as $m) {

            if ($m->category_id == (string)$data['category_id']) {

                if (
                    $data['subcategory_name'] == null
                    || $data['subcategory_status'] == null
                ) {

                    Session::forget('error');
                    Session::put('error', 'Add subcategory fail');
                    break;
                } else {

                    DB::table('tbl_subcategory')->insert($data);
                    Session::forget('error');
                    Session::put('message', 'Add subcategory');
                    break;
                }
            } else {

                Session::put('error', 'Please choose one category in the box');
            }
        }
        return Redirect::to('add-sub-category')->withInput();
    }
    public function unactive_sub_category($subcategory_id)
    {
        DB::table('tbl_subcategory')
            ->where('subcategory_id', $subcategory_id)
            ->update(['subcategory_status' => 0]);
        DB::table('tbl_product')
            ->where('subcategory_id', $subcategory_id)
            ->update(['product_status' => 0]);

        Session::put('message', 'Unactive subcategory ' . $subcategory_id);
        return Redirect::to('show-sub-category');
    }
    public function active_sub_category($subcategory_id)
    {
        DB::table('tbl_subcategory')
            ->where('subcategory_id', $subcategory_id)
            ->update(['subcategory_status' => 1]);

        Session::put('message', 'Active subcategory ' . $subcategory_id);
        return Redirect::to('show-sub-category');
    }
    public function edit_sub_category($subcategory_id)
    {
        $get_category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->get();
        $edit_sub_category = DB::table('tbl_subcategory')
            ->where('subcategory_id', $subcategory_id)
            ->get();

        $manager_sub_category = view('admin.subcategory.edit_sub_category')
            ->with('edit_sub_category', $edit_sub_category)
            ->with('get_category', $get_category);

        return view('components.admin_layout.admin_layout')
            ->with('admin.edit_sub_category', $manager_sub_category);
    }
    public function delete_sub_category($subcategory_id)
    {
        DB::table('tbl_subcategory')
            ->where('subcategory_id', $subcategory_id)
            ->delete();
        Session::put('message', 'Delete subcategory ' . $subcategory_id);
        return Redirect::to('show-sub-category');
    }
    public function update_sub_category(Request $request, $subcategory_id)
    {
        $data = array();
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcategory_desc'] = $request->subcategory_desc;
        $data['category_id'] = $request->category_id;
        $get_category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->get();
        $manager_category = view('admin.subcategory.add_sub_category')
            ->with('get_category', $get_category);

        foreach ($manager_category->get_category as $m) {

            if ($m->category_id == (string)$data['category_id']) {

                if ($data['subcategory_name'] == null) {

                    Session::forget('error');
                    Session::put('error', 'Update subcategory fail');
                    break;
                } else {

                    DB::table('tbl_subcategory')
                        ->where('subcategory_id', $subcategory_id)
                        ->update($data);

                    Session::forget('error');
                    Session::put('message', 'Update subcategory');
                    break;
                }
            } else {

                Session::put('error', 'Please choose one category in the box');
            }
        }
        return Redirect::to('show-sub-category');
    }
    //End Admin Page


    //public page
    public function shop_subcategory(Request $request, $subcategory_id)
    {
        $category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();
        $subcategory = DB::table('tbl_subcategory')
            ->where('subcategory_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'asc') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_price', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'desc') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_price', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'atoz') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_name', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'ztoa') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_name', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->paginate(3)->appends(request()->query());
            }
        } else {
            $subcategory_by_id = Product::with('subcategory')
                ->where('tbl_product.subcategory_id', $subcategory_id)
                ->where('tbl_product.product_status', 1)
                ->paginate(3)->appends(request()->query());
        }

        return view('pages.subcategory.shop_subcategory')
            ->with(compact('category', 'subcategory', 'subcategory_by_id'));
    }
    //end public page
}
