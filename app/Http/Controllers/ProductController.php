<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function show_product()
    {
        $show_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
            ->orderBy('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.show_product')->with('show_product', $show_product);
        return view('admin_layout')->with('admin.show_product', $manager_product);
    }

    public function select_category(Request $request)
    {
        $data = $request->all();
        // var_dump($data);
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "category") {
                $select_subcategory = DB::table('tbl_subcategory')->where('category_id', $data['cate_id'])->where('subcategory_status', '1')->orderby('category_id', 'asc')->get();
                $output .= '<option value="">Choose your subcategory</option>';
                foreach ($select_subcategory as $key => $sub) {
                    $output .= '<option value="' . $sub->subcategory_id . '">' . $sub->subcategory_name . '</option>';
                }
            }
            echo $output;
        }
    }

    public function add_product()
    {
        $get_category = DB::table('tbl_category')->where('category_status', '1')->get();
        $get_subcategory = DB::table('tbl_subcategory')->where('subcategory_status', '1')->get();
        return view('admin.add_product')->with(compact('get_category', 'get_subcategory'));
    }

    public function save_product(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_status' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['subcategory_id'] = $request->subcategory;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($data['category_id'] == null  || $data['subcategory_id'] == null) {
            Session::put('error', 'Choose category and subcategory');
            return Redirect::to('/add-product');
        } else {
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/upload/product', $new_image);
                $data['product_image'] = $new_image;
                DB::table('tbl_product')->insert($data);
                Session::put('message', 'Add product');
                return Redirect::to('/show-product');
            } else {
                $data['product_image'] = '';
                DB::table('tbl_product')->insert($data);
                Session::put('message', 'Add product without image');
                return Redirect::to('/show-product');
            }
        }
    }
    public function unactive_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Unactive product ' . $product_id);
        return Redirect::to('/show-product');
    }

    public function active_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Active product ' . $product_id);
        return Redirect::to('/show-product');
    }

    public function edit_product($product_id)
    {
        $get_category = DB::table('tbl_category')->where('category_status', '1')->get();
        $get_subcategory = DB::table('tbl_subcategory')->where('subcategory_status', '1')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with(compact('edit_product', 'get_category', 'get_subcategory'));
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['subcategory_id'] = $request->subcategory;
        $get_image = $request->file('product_image');
        if ($data['category_id'] == null  || $data['subcategory_id'] == null) {
            Session::put('error', 'Choose category and subcategory');
            return Redirect::to('/edit-product'.'/'.$product_id);
        } else {
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/upload/product', $new_image);
                $data['product_image'] = $new_image;
                DB::table('tbl_product')->where('product_id', $product_id)->update($data);
                Session::put('message', 'Update product'.$product_id);
                return Redirect::to('/show-product');
            } else {
                DB::table('tbl_product')->where('product_id', $product_id)->update($data);
                Session::put('message', 'Update product '. $product_id .' without change image');
                return Redirect::to('/show-product');
            }
        }
    }

    public function delete_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Successfully delete product ' . $product_id);
        return Redirect::to('/show-product');
    }
}
